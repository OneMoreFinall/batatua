<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\AdminNoteController as AdminNoteController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::view('/contact', 'contact')->name('contact');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove'); // hapus item dari cart

Route::get('/checkout', [CartController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes (akses khusus admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('menu', AdminMenuController::class);
Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
Route::post('/gallery/update/{id}', [AdminGalleryController::class, 'update'])->name('gallery.update');
Route::get('/profile', [ProfileController::class, 'adminEdit'])->name('profile.edit');
Route::resource('notes', AdminNoteController::class);
});

// login routes (admin)
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');

require __DIR__.'/auth.php';
