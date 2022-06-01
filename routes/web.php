<?php

use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileStatsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/home',[HomeController::class,'index'])->name('home');
    Route::get('/logout',[LoginController::class,'destroy'])->name('logout');
    Route::post('/tweet/compose',[PostController::class,'store'])->name('tweet');
    Route::post('/post/{id}/comment',[PostController::class,'storeComment'])->name('comment');
    Route::post('/follow/{id}',[FolloWcontroller::class,'store'])->whereNumber('id')->name('follow');
    Route::post('/unfollow/{id}',[FolloWcontroller::class,'destroy'])->whereNumber('id')->name('unfollow');
    Route::post('/post/{id}/like',[LikeController::class,'like'])->whereNumber('id')->name('like');
    Route::post('/post/{id}/unlike',[LikeController::class,'unlike'])->whereNumber('id')->name('unlike');
    Route::post('/{username}/private',[EditProfileController::class,'makePrivate'])->name('makePrivate');
    Route::post('/{username}/public',[EditProfileController::class,'makePublic'])->name('makePublic');
    Route::get('/{username}/notifications',[NotificationsController::class,'index'])->name('notifications');
    Route::get('/{username}/notification/{id}',[NotificationsController::class,'getOne'])->name('notification');
});

Route::middleware('guest')->group(function () {
    Route::get('/', function () {return view('welcome');});
    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login',[LoginController::class,'authenticate']);
    Route::get('/signup',[SignUpController::class,'index'])->name('signup');
    Route::post('/signup',[SignUpController::class,'store']);
});

Route::middleware('isPrivate')->group(function () {
    Route::controller(ProfileStatsController::class)->group(function () {
        Route::get('/{username}/following','following')->name('following');
        Route::get('/{username}/followers','followers')->name('followers');
        Route::get('/{username}/likes','likes')->name('likes');
    });
});

Route::get('/explore/{category_name}',[ExploreController::class,'index'])->name('explore');
Route::get('/post/{id}',[PostController::class,'index'])->whereNumber('id')->name('post');
Route::get('/search',[SearchController::class,'index'])->name('search');
Route::get('/{username}',[UserProfileController::class,'index'])->middleware('checkIfExists');

