<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

Route::get('/get-candidates-json', [CandidateController::class, 'getJsonCandidates']);
Route::get('/candidate-list', [CandidateController::class, 'index'])->name('candidate-list');

Route::get('/create-candidate', [CandidateController::class, 'create'])->name('create-candidate');
Route::post('/store-candidate', [CandidateController::class, 'store'])->name('store-candidate');

Route::get('/edit-candidate/{id}', [CandidateController::class, 'edit'])->name('edit-candidate');
Route::put('/update-candidate/{id}', [CandidateController::class, 'update'])->name('update-candidate');
Route::get('/export-candidate-list-excel', [CandidateController::class, 'exportCandidateListExcel'])->name('export-candidate-list-excel');
Route::delete('/delete-candidate/{id}', [CandidateController::class, 'destroy'])->name('delete-candidate');
