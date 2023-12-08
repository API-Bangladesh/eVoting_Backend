<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

Route::get('/application-list', [ApplicationController::class, 'index'])->name('application-list');

Route::get('/create-application-form', [ApplicationController::class, 'createApplicationForm'])->name('create-application-form');
Route::post('/store-application-form', [ApplicationController::class, 'storeApplicationForm'])->name('store-application-form');

Route::get('/approve-application/{id}', [ApplicationController::class, 'updateApproveStatus'])->name('approve-application');
Route::put('/decline-application/{id}', [ApplicationController::class, 'updateDeclinedStatus'])->name('decline-application');

Route::get('/download-application-list-pdf', [ApplicationController::class, 'downloadSubmissionListPDF'])->name('download-application-list-pdf');

Route::put('/batch-update-application-status', [ApplicationController::class, 'batchUpdateApplicationStatus'])->name('batch-update-application-status');
