<?php

use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/testing', function () {
    return view('layouts.app');
})->name('testing');

Route::get('/login-page', [AuthController::class, 'loginPage'])->name('login.page');
Route::get('/regis-page', [AuthController::class, 'regisPage'])->name('regis.page');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/categories', [KategoriController::class, 'store'])->name('store.kategori');
    Route::get('/categories/add', [KategoriController::class, 'create'])->name('create.kategori');
    Route::post('/products', [ProdukController::class, 'store'])->name('store.produk');
    Route::get('/products/add', [ProdukController::class, 'create'])->name('create.produk');
    Route::get('/index/categories', [KategoriController::class, 'index'])->name('admin.categories.index');
    Route::get('/listproduk/admin', [ProdukController::class, 'index'])->name('admin.products.index');
});
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'tampilProduk'])->name('customer.dashboard');
});
