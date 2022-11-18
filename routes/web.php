<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'index'])->name("register");
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/muro', [PostController::class, 'index'])->name('posts.index');
