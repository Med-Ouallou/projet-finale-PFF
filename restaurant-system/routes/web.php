<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Public\PublicPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicPageController::class, 'accueil'])->name('accueil');
Route::get('/menu', [PublicPageController::class, 'menu'])->name('menu');
Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');

// Admin Auth Routes (no middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Protected Admin Routes
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menus
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{id}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/menus/{id}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{id}', [MenuController::class, 'destroy'])->name('menus.destroy');
    Route::patch('/menus/{id}/toggle', [MenuController::class, 'toggleActive'])->name('menus.toggle');

    // Menu Items
    Route::get('/menu-items', [MenuItemController::class, 'index'])->name('menu-items.index');
    Route::post('/menu-items', [MenuItemController::class, 'store'])->name('menu-items.store');
    Route::get('/menu-items/{id}/edit', [MenuItemController::class, 'edit'])->name('menu-items.edit');
    Route::put('/menu-items/{id}', [MenuItemController::class, 'update'])->name('menu-items.update');
    Route::delete('/menu-items/{id}', [MenuItemController::class, 'destroy'])->name('menu-items.destroy');
    Route::patch('/menu-items/{id}/toggle', [MenuItemController::class, 'toggleStatus'])->name('menu-items.toggle');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::patch('/categories/{id}/toggle', [CategoryController::class, 'toggleActive'])->name('categories.toggle');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Inventory
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
    Route::get('/inventory/{inventoryItem}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::put('/inventory/{inventoryItem}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::delete('/inventory/{inventoryItem}', [InventoryController::class, 'destroy'])->name('inventory.destroy');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
