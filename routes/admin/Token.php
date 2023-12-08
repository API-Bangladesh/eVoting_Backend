<?php

use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::get('/token-list', [TokenController::class, 'index'])->name('token-list');
Route::get('/generate-tokens', [TokenController::class, 'generateTokens'])->name('generate-tokens');
Route::get('/generated-token-list', [TokenController::class, 'generateTokenList'])->name('generated-token-list');
Route::get('/lock-online-token-generation', [TokenController::class, 'lockOnlineTokenGeneration'])->name('lock-online-token-generation');
