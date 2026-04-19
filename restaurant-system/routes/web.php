<?php

use App\Http\Controllers\Public\PublicPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicPageController::class, 'accueil'])->name('accueil');
Route::get('/menu', [PublicPageController::class, 'menu'])->name('menu');
Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');
