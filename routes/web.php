<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/mail', function () {
//     $mail = new App\Mail\testMail('hello');
//     Mail::send($mail);
//     return view('mail');
// });

// Route::group(['prefix' => '/articles', 'middleware' => 'auth'], function () {
//     Route::get('', [ArticleController::class, 'index']);
//     Route::post('', [ArticleController::class, 'store']);
//     Route::get('/create', [ArticleController::class, 'create']);
//     Route::get('/{id}', [ArticleController::class, 'show'])->name('show');
//     Route::get('/{id}/edit', [ArticleController::class, 'update']);
//     Route::post('/{id}/edit', [ArticleController::class, 'store']);

//     Route::get('/{id}/delete', [ArticleController::class, 'destroy']);
// });

// Route::group(['prefix' => '/comments', 'middleware' => 'auth'], function () {
//     Route::get('', [ArticleCommentController::class, 'index'])->name('index');
//     Route::post('/{id}/add_comment', [ArticleCommentController::class, 'store']);
//     Route::get('/{id}/accept', [ArticleCommentController::class, 'accept']);
//     Route::get('/{id}/delete', [ArticleCommentController::class, 'destroy']);
// });

// Route::get('/register', [AuthController::class, 'register']);
// Route::post('/register', [AuthController::class, 'customRegister']);

// Route::get('/login', [AuthController::class, 'index'])->name('login');
// Route::post('/login', [AuthController::class, 'customLogin']);

// Route::get('/logout', [AuthController::class, 'logout']);
