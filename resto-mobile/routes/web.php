<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilePageController;

Route::get('/', function () {
    return redirect()->route('mobile.accueil');
});

Route::prefix('mobile')->group(function () {
    Route::get('/', [MobilePageController::class, 'accueil'])->name('mobile.accueil');
    Route::get('/menu', [MobilePageController::class, 'menu'])->name('mobile.menu');
    Route::get('/contact', [MobilePageController::class, 'contact'])->name('mobile.contact');
});
