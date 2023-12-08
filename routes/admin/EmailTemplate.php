<?php

use App\Http\Controllers\EmailTemplateController;
use Illuminate\Support\Facades\Route;

Route::get('/email-template-list', [EmailTemplateController::class, 'index'])->name('email-template-list');

Route::get('/create-email-template', [EmailTemplateController::class, 'create'])->name('create-email-template');
Route::post('/store-email-template', [EmailTemplateController::class, 'store'])->name('store-email-template');

Route::get('/edit-email-template/{id}', [EmailTemplateController::class, 'edit'])->name('edit-email-template');
Route::put('/update-email-template/{id}', [EmailTemplateController::class, 'update'])->name('update-email-template');

Route::delete('/delete-email-template/{id}', [EmailTemplateController::class, 'destroy'])->name('delete-email-template');

Route::get('/email-sending-status', [EmailTemplateController::class, 'viewEmailSendingStatus'])->name('email-sending-status');

Route::get('/send-email-by-category/{emailTemplate}', [EmailTemplateController::class, 'sendEmailTemplate'])->name('send-email-by-category');
