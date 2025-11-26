<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\ProductController;
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
    Route::controller(CategoriesController::class)->group(function () {
        Route::get('/index/categories', 'index')->name('index.categories');
        Route::get('create/categories', 'create')->name('create.categories');
        Route::post('/store/categories', 'store')->name('store.categories');
        Route::get('/edit/{id}/categories', 'edit')->name('edit.categories');
        Route::patch('/update/{id}/categories', 'update')->name('update.categories');
        Route::delete('/destroy/{id}/categories', 'destroy')->name('destroy.categories');
    });
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    });
    Route::controller(ProductController::class)->group(function(){
        Route::get('/index/products', 'index')->name('index.products');
        Route::get('/create/products', 'create')->name('create.products');
        Route::post('/store/products', 'store')->name('store.products');
        Route::get('/edit/{id}/products', 'edit')->name('edit.products');
        Route::get('/show/{id}/products', 'show')->name('show.products');
        Route::patch('/update/{id}/products', 'update')->name('update.products');
        Route::delete('/destroy/{id}/products', 'destroy')->name('delete.products');
    });
});
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer/dashboard', 'dashboard')->name('customer.dashboard');
    });
    Route::controller(CustomerProductController::class)->group(function(){
        Route::get('/products','index')->name('customer.products');
        Route::get('/products/{id}','show')->name('customer.products.show');
    });
    Route::controller(CartController::class)->group(function(){
        Route::post('/cart/add/{products}','add')->name('cart.add');
        Route::get('/cart','index')->name('cart.index');
    });
});
