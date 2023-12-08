<?php

use App\Http\Controllers\VoterController;
use Illuminate\Support\Facades\Route;

Route::get('/create-voter', [VoterController::class, 'create'])->name('create-voter');
Route::post('/store-voter', [VoterController::class, 'store'])->name('store-voter');
Route::delete('/delete-voter/{id}', [VoterController::class, 'destroyVoter'])->name('delete-voter');
Route::get('/edit-voter/{id}', [VoterController::class, 'edit'])->name('edit-voter');
Route::put('/update-voter/{id}', [VoterController::class, 'update'])->name('update-voter');

Route::get('/voter-list', [VoterController::class, 'index'])->name('voter-list');
Route::get('/search-voters', [VoterController::class, 'search'])->name('search-voters');

Route::delete('/trash-voter/{id}', [VoterController::class, 'trash'])->name('trash-voter');
Route::delete('/delete-voter/{id}', [VoterController::class, 'destroy'])->name('delete-voter');
Route::put('/restore-voter/{id}', [VoterController::class, 'restore'])->name('restore-voter');

Route::get('/import-voters', [VoterController::class, 'importVoters'])->name('import-voters');
Route::post('/store-imported-voters', [VoterController::class, 'storeImportedVoters'])->name('store-imported-voters');

Route::get('/permanently-delete-voters', [VoterController::class, 'permanentlyDeleteVoters'])->name('voter.permanently-delete-voters');
Route::get('/deleted-voter-list', [VoterController::class, 'viewDeletedVoterList'])->name('deleted-voter-list');

Route::get('/online-voter-list', [VoterController::class, 'viewOnlineVoterList'])->name('online-voter-list');
Route::get('/offline-voter-list', [VoterController::class, 'viewOfflineVoterList'])->name('offline-voter-list');

Route::get('/download-voters-pdf', [VoterController::class, 'downloadVotersPDF'])->name('download-voters-pdf');
Route::get('/print-voters-pdf', [VoterController::class, 'printVotersPDF'])->name('print-voters-pdf');
Route::get('/VotersExportExcel', [VoterController::class, 'VotersExportExcel'])->name('VotersExportExcel');

Route::get('/count-voters-as-receiver', [VoterController::class, 'countVotersAsReceiver'])->name('count-voters-as-receiver');
