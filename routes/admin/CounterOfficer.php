<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CounterOfficerController;

Route::get('/counter-officer-list', [CounterOfficerController::class, 'index'])->name('counter-officer-list');

Route::get('/create-counter-officer', [CounterOfficerController::class, 'create'])->name('create-counter-officer');
Route::post('/store-counter-officer', [CounterOfficerController::class, 'store'])->name('store-counter-officer');

Route::get('/edit-counter-officer/{id}', [CounterOfficerController::class, 'edit'])->name('edit-counter-officer');
Route::put('/update-counter-officer/{id}', [CounterOfficerController::class, 'update'])->name('update-counter-officer');

Route::delete('/delete-counter-officer/{id}', [CounterOfficerController::class, 'destroy'])->name('delete-counter-officer');
