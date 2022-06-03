<?php

use App\Http\Controllers\Api\v1\TweetController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function (){
    Route::middleware('auth:sanctum')->group(function (){
        Route::controller(UserController::class)->group(function () {
            Route::get('/me','user');
            Route::get('me/following','followings');
            Route::get('me/follows','followers');
        });
        Route::controller(TweetController::class)->group(function () {
            Route::get('/tweets','mainFeed');
            Route::post('/tweets','tweet');
            Route::get('/tweets/{tweet_id}','show');
            Route::get('/tweets/replies','comments');
            Route::get('/tweet/{tweet_id}/reply','reply');
            Route::get('/tweet/{tweet_id}/like','like');
            Route::get('/tweet/{tweet_id}/unlike','unlike');
        });
    });
});
