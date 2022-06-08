<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// How to make livewire layouts
// Check out post like and unlike functionality with livewire
// How to add middlewares on livewire methods (For example only authorised user can like or create post)
// Why use policies and not FormRequests for authorizing user actions
// How to implement load more functionality without jquery

Route::middleware('auth')->group(function () {
    Route::controller(PostController::class)->group(function() {
        Route::post('/tweet/compose','store')->name('tweet');
        Route::post('/post/{id}/comment','storeComment')->name('comment');
        Route::post('/post/{id}/like','like')->whereNumber('id')->name('like');
        Route::post('/post/{id}/unlike','unlike')->whereNumber('id')->name('unlike');
    });
    Route::controller(UserController::class)->group(function () {
        Route::post('/follow/{id}','follow')->whereNumber('id')->name('follow');
        Route::post('/unfollow/{id}','unfollow')->whereNumber('id')->name('unfollow');
        Route::post('/{username}/private','makePrivate')->name('makePrivate');
        Route::post('/{username}/public','makePublic')->name('makePublic');
    });
    Route::controller(TokenController::class)->group(function () {
        Route::get('/token/create','index')->name('token.show');
        Route::post('/token/create','store')->name('token.store');
        Route::post('/token/delete/{token}','delete')->name('token.delete');
    });
    Route::controller(NotificationsController::class)->group(function () {
        Route::get('/{username}/notifications','index')->name('notifications');
        Route::get('/{username}/notifications/{id}','getOne')->name('notification');
    });
    Route::get('/home',[HomeController::class,'index'])->name('home');
    Route::get('/logout',[LoginController::class,'destroy'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::view('/','welcome');
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login','index')->name('login');
        Route::post('/login','authenticate')->name('login.create');
    });
    Route::controller(SignUpController::class)->group(function () {
        Route::get('/signup','index')->name('signup');
        Route::post('/signup','store')->name('signup.create');
    });
});

Route::middleware('isPrivate')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/{username}/following','following')->name('following');
        Route::get('/{username}/followers','followers')->name('followers');
        Route::get('/{username}/likes','likes')->name('likes');
    });
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/search','search')->name('search');
    Route::get('/explore/{category_name}','explore')->name('explore');
});

Route::get('/post/{id}',[PostController::class,'index'])->whereNumber('id')->name('post');
Route::get('/{username}',[UserController::class,'index'])->middleware('checkIfExists');
