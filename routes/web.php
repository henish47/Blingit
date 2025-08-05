<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Controller Imports
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaceOrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController; // Import the UserController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// ✅ Public Routes
Route::view('/', 'home')->name('home');
Route::view('/milk', 'milk')->name('milk');
Route::view('/vegetables', 'vegetables')->name('vegetables');
Route::view('/fruits', 'fruits')->name('fruits');
Route::view('/electronics', 'electronics')->name('electronics');
Route::view('/personal-products', 'personal-products')->name('personal-products');
Route::view('/product', 'product')->name('product');
Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');

// ✅ Authentication Routes
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ✅ Email Verification Routes
Route::get('/email/verify', function () {
    return view('verify-email');
})->middleware('auth')->name('verification.notice');

// Email verification link click
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // Mark email as verified

    // Redirect to login with success message
    return redirect()->route('login')->with('status', 'Email verified successfully. You can now login.');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ✅ Verified & Authenticated User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/edit_profile', 'edit_profile')->name('edit_profile');
    Route::get('/cart', fn () => view('cart'))->name('cart');
    Route::get('/checkout', fn () => view('checkout'))->name('checkout');
    Route::get('/place-order', [PlaceOrderController::class, 'show'])->name('place-order');
    Route::get('/orders', [OrderController::class, 'userOrders'])->name('orders');
});

// ✅ Admin Routes
// All routes in this group are prefixed with `/admin` (e.g., /admin/dashboard)
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/coupons', 'admin.coupons')->name('admin.coupons');
    Route::view('/profile', 'admin.profile')->name('admin.profile');
    Route::view('/contact', 'admin.contact')->name('admin.contact');
    
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders');

    // Resource routes for Products, Categories, and Users
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class); // This replaces the static view route
});
