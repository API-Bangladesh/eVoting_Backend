<?php

use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

Route::get('/online-result-slideshow', [ResultController::class, 'onlineResultSlideshow'])->name('online-result-slideshow');
Route::get('/offline-result-show', [ResultController::class, 'offlineResultShow'])->name('offline-result-show');
Route::get('/view-printable-report', [ResultController::class, 'viewPrintableReport'])->name('view-printable-report');

Route::get('/offline-voting-result', [ResultController::class, 'offlineVotingResult'])->name('offline-result-insert-view');
Route::put('/update-offline-voting-result', [ResultController::class, 'updateOfflineVotingResult'])->name('update-offline-voting-result');
