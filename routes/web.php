<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileStatsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function (){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login',[LoginController::class,'authenticate']);
    Route::get('/signup',[SignUpController::class,'index'])->name('signup');
    Route::post('/signup',[SignUpController::class,'store']);
});

//User is authenticated
Route::middleware('auth')->group(function () {
    Route::get('/home',[HomeController::class,'index'])->name('home');
    Route::get('/logout',[LoginController::class,'destroy'])->name('logout');
    Route::post('/tweet/compose',[PostController::class,'store'])->name('tweet');
    Route::get('/search',[SearchController::class,'index'])->name('search');
    Route::get('/post/{id}',[PostController::class,'index'])->whereNumber('id');
    Route::post('/follow/{id}',[FolloWcontroller::class,'store'])->whereNumber('id')->name('follow');
    Route::post('/unfollow/{id}',[FolloWcontroller::class,'destroy'])->whereNumber('id')->name('unfollow');
    Route::post('/post/{id}/like',[LikeController::class,'like'])->whereNumber('id')->name('like');
    Route::post('/post/{id}/unlike',[LikeController::class,'unlike'])->whereNumber('id')->name('unlike');
    Route::post('/post/{id}/comment',[CommentController::class,'create'])->name('comment');
    Route::get('/{username}/following',[ProfileStatsController::class,'following'])->name('following');
    Route::get('/{username}/followers',[ProfileStatsController::class,'followers'])->name('followers');
    Route::get('/{username}/likes',[ProfileStatsController::class,'likes'])->name('likes');
    Route::get('/{username}',[UserProfileController::class,'index']);
});
