<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

// ContactController
Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/', [ContactController::class, 'back'])->name('contact.back');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');
Route::get('/confirm', fn () => redirect()->route('contact.index'));
Route::get('/thanks', fn () => redirect()->route('contact.index'));

// Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/search', [AdminController::class, 'search'])->name('admin.search');
Route::get('/reset', fn () => redirect()->route('admin'))->name('admin.reset');
Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
Route::delete('/delete/{contact}', [AdminController::class, 'destroy'])->name('admin.destroy');
