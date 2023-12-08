<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/role-list', [RoleController::class, 'index'])->name('role-list');

Route::get('/create-role', [RoleController::class, 'create'])->name('create-role');
Route::post('/store-role', [RoleController::class, 'store'])->name('store-role');

Route::get('/edit-role/{id}', [RoleController::class, 'edit'])->name('edit-role');
Route::put('/update-role/{id}', [RoleController::class, 'update'])->name('update-role');

Route::delete('/delete-role/{id}', [RoleController::class, 'destroy'])->name('delete-role');

Route::get('/edit-role/{id}/permissions', [RoleController::class, 'editRolePermissions'])->name('edit-role-permissions');
Route::put('/update-role/{id}/permissions', [RoleController::class, 'updateRolePermissions'])->name('update-role-permissions');
