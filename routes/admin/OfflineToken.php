<?php

use App\Http\Controllers\OfflineTokenController;
use Illuminate\Support\Facades\Route;

Route::get('/offline-token-list', [OfflineTokenController::class, 'index'])->name('offline-token-list');

Route::get('/create-offline-token', [OfflineTokenController::class, 'create'])->name('create-offline-token');
Route::post('/store-offline-token', [OfflineTokenController::class, 'store'])->name('store-offline-token');

Route::get('/search-offline-token', [OfflineTokenController::class, 'search'])->name('search-offline-token');
Route::get('/re-print-offline-token/{id}', [OfflineTokenController::class, 'rePrint'])->name('re-print-offline-token');
