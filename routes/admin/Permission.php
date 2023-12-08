<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/permission-list', [PermissionController::class, 'index'])->name('permission-list');

Route::get('/create-permission', [PermissionController::class, 'create'])->name('create-permission');
Route::post('/store-permission', [PermissionController::class, 'store'])->name('store-permission');

Route::get('/edit-permission/{id}', [PermissionController::class, 'edit'])->name('edit-permission');
Route::put('/update-permission/{id}', [PermissionController::class, 'update'])->name('update-permission');

Route::delete('/delete-permission/{id}', [PermissionController::class, 'destroy'])->name('delete-permission');
