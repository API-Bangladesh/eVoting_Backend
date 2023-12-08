<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/user-list', [UserController::class, 'index'])->name('user-list');

Route::get('/create-user', [UserController::class, 'create'])->name('create-user');
Route::post('/store-user', [UserController::class, 'store'])->name('store-user');

Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');
Route::put('/update-user/{id}', [UserController::class, 'update'])->name('update-user');

Route::delete('/trash-user/{id}', [UserController::class, 'trash'])->name('trash-user');
Route::put('/restore-user/{id}', [UserController::class, 'restore'])->name('restore-user');
Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('delete-user');

Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile');
Route::put('/update-profile/{id}', [UserController::class, 'updateProfile'])->name('update-profile');
