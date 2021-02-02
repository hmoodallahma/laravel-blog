<?php

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

Route::prefix('v1')->namespace('Api\V1')->group(function () {
    Route::middleware(['auth:api', 'verified'])->group(function () {
        // Comments
        Route::apiResource('comments', 'CommentController')->only('destroy');
        Route::apiResource('posts.comments', 'PostCommentController')->only('store');

        // Posts
        Route::apiResource('posts', 'PostController')->only(['update', 'store', 'destroy']);
        

        // Users
        Route::apiResource('users', 'UserController')->only('update');

        // Media
        Route::apiResource('media', 'MediaController')->only(['store', 'destroy']);
    });

    Route::post('/authenticate', 'Auth\AuthenticateController@authenticate')->name('authenticate');

    // Comments
    Route::apiResource('posts.comments', 'PostCommentController')->only('index');
    Route::apiResource('users.comments', 'UserCommentController')->only('index');
    Route::apiResource('comments', 'CommentController')->only(['index', 'show']);

    // Posts
    Route::apiResource('posts', 'PostController')->only(['index', 'show']);
    Route::apiResource('users.posts', 'UserPostController')->only('index');

    // Users
    Route::apiResource('user_posts', 'UserController')->only(['index', 'show','search_posts']);

    // Media
    Route::apiResource('media', 'MediaController')->only('index');
});
