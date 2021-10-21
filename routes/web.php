<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/articles', [ArticleController::class, 'index']);
