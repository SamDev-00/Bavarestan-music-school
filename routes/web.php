<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ServiceRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/blog', [PageController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{slug}', [PageController::class, 'blogShow'])->name('blog.show');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/books', [PageController::class, 'books'])->name('books.index');
Route::get('/books/{book}/download', [PageController::class, 'downloadBook'])->name('books.download');
Route::get('/music/{track}/stream', [PageController::class, 'streamTrack'])->name('music.stream');
Route::get('/services', [ServiceRequestController::class, 'create'])->name('services.create');
Route::post('/services', [ServiceRequestController::class, 'store'])->name('services.store');

Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');
Route::post('/register/manage', [RegistrationController::class, 'manage'])->name('register.manage');
Route::post('/register/cancel', [RegistrationController::class, 'cancel'])->name('register.cancel');
