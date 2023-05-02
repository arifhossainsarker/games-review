<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\GamesCommentController;
use App\Http\Controllers\GamesListsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::resource('games-list', GamesListsController::class);
    Route::resource('games-comments', GamesCommentController::class);
});

/**
 * User Route
 */

Route::resource('comment', CommentsController::class);
