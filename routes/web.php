<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaceOrderController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\RegisterController;

// Demo form 
use App\Http\Controllers\DemoController;


// Public grocery eCommerce pages
Route::view('/', 'home');
Route::view('/milk', 'milk')->name('milk');
Route::view('/vegetables', 'vegetables')->name('vegetables');
Route::view('/fruits', 'fruits')->name('fruits');
Route::view('/elctronics', 'electronics')->name('electronics');
Route::view('/personal-products', 'personal-products')->name('personal-products');
Route::view('/product', 'product'); // For demo, static product page
Route::view('/cart', 'cart');
Route::view('/checkout', 'checkout');
Route::get('/place-order', [PlaceOrderController::class, 'show'])->name('place-order');
Route::get('/orders', [OrderController::class, 'userOrders'])->name('orders');
Route::view('/contact', 'contact');
Route::view('/about', 'about');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::view('/otp-verify', 'verify-otp')->name('otp.verify');
Route::post('/reset-password', [ResetPasswordController::class, 'update'])->name('password.update');
Route::get('/reset-password', function () {
    return view('reset-password');
})->name('password.reset');


Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/categories', 'admin.categories')->name('admin.categories');
    Route::view('/coupons', 'admin.coupons')->name('admin.coupons');
    Route::view('/products', 'admin.products')->name('admin.products');
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders');
    Route::view('/users', 'admin.users')->name('admin.users');
    Route::view('/profile', 'admin.profile')->name('admin.profile');
    Route::view('/contact', 'admin.contact')->name('admin.contact');
});

