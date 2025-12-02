<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});
// ContactController
Route::get('/', [ContactController::class, 'index']);
Route::post('/', [ContactController::class, 'back'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);
Route::get('/confirm', fn () => redirect()->route('contact.index'));
Route::get('/thanks', fn () => redirect()->route('contact.index'));

// Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
Route::delete('/admin/{contact}', [AdminController::class, 'destroy'])->name('admin.destroy');
