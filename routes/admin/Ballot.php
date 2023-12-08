<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BallotController;

Route::get('/ballot-papers', [BallotController::class, 'index'])->name('ballot-papers');

Route::get('/create-ballot', [BallotController::class, 'create'])->name('create-ballot');
Route::post('/store-ballot', [BallotController::class, 'store'])->name('store-ballot');

Route::get('/edit-ballot/{id}', [BallotController::class, 'edit'])->name('edit-ballot');
Route::put('/update-ballot/{id}', [BallotController::class, 'update'])->name('update-ballot');

Route::delete('/delete-ballot/{id}', [BallotController::class, 'destroy'])->name('delete-ballot');
Route::get('/delete-ballot-item/{id}', [BallotController::class, 'destroyBallotItem'])->name('delete-ballot-item');

Route::get('/view-ballot', [BallotController::class, 'viewBallot'])->name('view-ballot');
Route::get('/single-ballot/{id}', [BallotController::class, 'singleBallot'])->name('single-ballot');
