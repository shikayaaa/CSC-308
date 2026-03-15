<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usersController;

Route::get('/users', [usersController::class, 'index']);
Route::post('/users', [usersController::class, 'store'])->name('user.create');
Route::get('/users/{id}', [usersController::class, 'show'])->name('user.show');