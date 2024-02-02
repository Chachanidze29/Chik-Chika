<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('auth')->group(function (){
    Route::get('/email/verify', function (Request $request) {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/home');
        }
        return view('auth.verify-email');
    })->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}',function (EmailVerificationRequest $request){
        $request->fulfill();
        return redirect('/home');
    })->name('verification.verify');
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');
});

Route::middleware(['auth','verified'])->group(function () {
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
});

Route::get('/logout',[LoginController::class,'destroy'])->name('logout')->middleware('auth');

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
