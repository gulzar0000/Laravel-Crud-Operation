<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [UserController::class, 'register']);
Route::get('/show', [UserController::class, 'show'])->name('show');
Route::post('/store', [UserController::class, 'store'])->name('store');
Route::get('/users/{id}', [UserController::class, 'getUser'])->name('getUser');
Route::put('/users/{id}', [UserController::class, 'updateUser'])->name('updateUser');
Route::delete('/delete/{post}', [UserController::class, 'delete'])->name('delete');