<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PositionController;

Route::get('/position-list', [PositionController::class, 'index'])->name('position-list');

Route::get('/create-position', [PositionController::class, 'create'])->name('create-position');
Route::post('/store-position', [PositionController::class, 'store'])->name('store-position');

Route::get('/edit-position/{id}', [PositionController::class, 'edit'])->name('edit-position');
Route::put('/update-position/{id}', [PositionController::class, 'update'])->name('update-position');

Route::delete('/delete-position/{id}', [PositionController::class, 'destroy'])->name('delete-position');
