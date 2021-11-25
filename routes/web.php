<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/create', [ArticleController::class, 'create']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::post('/articles/{id}/add_comment', [ArticleCommentController::class, 'store']);
Route::post('/articles', [ArticleController::class, 'store']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'customRegister']);

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'customLogin']);

Route::get('/logout', [AuthController::class, 'logout']);