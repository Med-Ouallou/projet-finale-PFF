<?php

use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Public\PublicPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicPageController::class, 'accueil'])->name('accueil');
Route::get('/menu', [PublicPageController::class, 'menu'])->name('menu');
Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminPageController::class, 'login'])->name('login');
    Route::post('/login', [AdminPageController::class, 'login'])->name('login.post');
    Route::get('/dashboard', [AdminPageController::class, 'dashboard'])->name('dashboard');
    Route::get('/menu', [AdminPageController::class, 'menuItems'])->name('menu-items');
    Route::get('/categories', [AdminPageController::class, 'categories'])->name('categories');
    Route::get('/reports', [AdminPageController::class, 'reports'])->name('reports');
});
