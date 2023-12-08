<?php

use App\Http\Controllers\EmailLogController;
use Illuminate\Support\Facades\Route;

Route::get('email-log-list', [EmailLogController::class, 'index'])->name('email-log-list');
Route::get('search-email-logs', [EmailLogController::class, 'search'])->name('search-email-logs');
