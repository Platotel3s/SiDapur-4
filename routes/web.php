<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/testing', function () {
    return view('layouts.app');
})->name('testing');

Route::controller(AuthController::class)->group(function(){
    Route::get('login-page','loginPage')->name('login.page');
    Route::get('regis-page','regisPage')->name('regis.page');
    Route::post('/register','register')->name('register');
    Route::post('/login','login')->name('login');
    Route::post('/logout','logout')->name('logout');
    Route::get('forgot-password','forgotPasswordPage')->name('forgot.page');
    Route::post('forgot-password','forgotPassword')->name('forgot.send');
    Route::get('/reset-password','resetPasswordPage')->name('reset.page');
    Route::post('/reset-password','resetPassword')->name('reset.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth');
    Route::post('/profile/update-password', [AuthController::class, 'updatePassword'])->name('profile.password');

});

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
        Route::get('/admin/daftar/user', 'indexCustomer')->name('index.user');
        Route::post('/hapus/customer/{id}', 'destroyCustomer')->name('hapus.customer');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/index/products', 'index')->name('index.products');
        Route::get('/create/products', 'create')->name('create.products');
        Route::post('/store/products', 'store')->name('store.products');
        Route::get('/edit/{id}/products', 'edit')->name('edit.products');
        Route::get('/show/{id}/products', 'show')->name('show.products');
        Route::patch('/update/{id}/products', 'update')->name('update.products');
        Route::delete('/destroy/{id}/products', 'destroy')->name('delete.products');
    });
    Route::controller(PaymentController::class)->group(function () {
        Route::get('/admin/payments', 'index')->name('index.payment');
        Route::post('/admin/payment/verify/{id}', 'verifyPayment')->name('admin.payment.verify');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('admin/orders', 'index')->name('admin.orders.index');
        Route::post('/admin/orders/{order}/marked', 'sudahBayar')->name('mark.paid');
        Route::get('/orderan/custom/bumbu', 'indexCustom')->name('custom.bumbu');
        Route::get('/tampilkan/{id}/custom', 'customConfirm')->name('admin.custom.show');
        Route::post('/admin/custom/{id}/approve', 'approveCustom')->name('admin.custom.approve');
        Route::post('/admin/reject/{id}/custom','rejectCustom')->name('admin.custom.reject');
    });

});

/* ----------------------------------------------------------------------------------------- */

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer/dashboard', 'dashboard')->name('customer.dashboard');
    });
    Route::controller(CustomerProductController::class)->group(function () {
        Route::get('/products', 'index')->name('customer.products');
        Route::get('/products/{id}', 'show')->name('customer.products.show');
    });
    Route::controller(CartController::class)->group(function () {
        Route::post('/cart/add/{products}', 'add')->name('cart.add');
        Route::get('/cart', 'index')->name('cart.index');
        Route::post('/cart/update/{id}', 'updateQuantity')->name('cart.update');
        Route::delete('/delete/item/{id}', 'removeItem')->name('cart.remove');
        Route::post('/checkout', 'checkout')->name('checkout');
        Route::get('/order/success/{id}', 'orderSuccess')->name('order.success');
    });
    Route::controller(AddressController::class)->group(function () {
        Route::get('/alamat', 'index')->name('alamat.index');
        Route::get('/alamat/tambah', 'create')->name('alamat.create');
        Route::post('/alamat/tambah', 'store')->name('alamat.store');
        Route::post('/alamat/set-utama/{id}', 'setUtama')->name('alamat.setUtama');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/order/list', 'orderList')->name('customer.orders');
        Route::get('/order/detail/{id}', 'orderDetail')->name('customer.order.detail');
        Route::get('/order/success', 'orderSuccess')->name('orderan.success');
        Route::post('/custom/order/{id}', 'customOrder')->name('custom.order');
    });
    Route::controller(PaymentController::class)->group(function () {
        Route::get('/index/payment', 'indexCustomer')->name('index.payment.customer');
        Route::get('/create/payment', 'create')->name('create.payment');
        Route::post('/store/payment','store')->name('customer.payments.store');
    });
});
