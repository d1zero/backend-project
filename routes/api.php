<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AuthController;

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
// Public routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Private routes
Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->resource('/article', ArticlesController::class);

Route::group(['prefix' => '/comments', 'middleware' => 'auth:sanctum'], function () {
    Route::get('', [ArticleCommentController::class, 'index'])->name('index');
    Route::post('/{id}/add_comment', [ArticleCommentController::class, 'store']);
    Route::get('/{id}/accept', [ArticleCommentController::class, 'accept']);
    Route::get('/{id}/delete', [ArticleCommentController::class, 'destroy']);
});


