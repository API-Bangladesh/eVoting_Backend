<?php

use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;

Route::get('activity-log-list', [ActivityLogController::class, 'index'])->name('activity-log-list');
Route::get('search-activity-logs', [ActivityLogController::class, 'search'])->name('search-activity-logs');
