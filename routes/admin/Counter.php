<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CounterController;

Route::get('/counter-list', [CounterController::class, 'index'])->name('counter-list');

Route::get('/create-counter', [CounterController::class, 'create'])->name('create-counter');
Route::post('/store-counter', [CounterController::class, 'store'])->name('store-counter');

Route::get('/edit-counter/{id}', [CounterController::class, 'edit'])->name('edit-counter');
Route::put('/update-counter/{id}', [CounterController::class, 'update'])->name('update-counter');

Route::delete('/delete-counter/{id}', [CounterController::class, 'destroy'])->name('delete-counter');
