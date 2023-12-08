<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;

Route::get('/qr-code-list', [QrCodeController::class, 'index'])->name('qr-code-list');
Route::get('/generate-qr-codes', [QrCodeController::class, 'generateQrCodes'])->name('generate-qr-codes');

Route::get('/download-qr-codes-pdf', [QrCodeController::class, 'downloadQrCodesPDF'])->name('download-qr-codes-pdf');
Route::get('/lock-qr-code', [QrCodeController::class, 'lockQrCode'])->name('lock-qr-code');

Route::get('/validate-qr-code-list', [QrCodeController::class, 'validateQrCodeList'])->name('validate-qr-code-list');
Route::post('/validate-qr-code', [QrCodeController::class, 'validateQrCode'])->name('validate-qr-code');

Route::get('/verify-qr-code-list', [QrCodeController::class, 'verifyQrCodeList'])->name('verify-qr-code-list');
Route::post('/verify-qr-code', [QrCodeController::class, 'verifyQrCode'])->name('verify-qr-code');
