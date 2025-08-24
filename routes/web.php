<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Controller Imports
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaceOrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryPageController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\NotificationController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{category:name}', [CategoryPageController::class, 'show'])->name('category.products');
Route::get('/product/{product:sku}', [ProductPageController::class, 'show'])->name('product.show');
Route::view('/milk', 'milk')->name('milk');
Route::view('/vegetables', 'vegetables')->name('vegetables');
Route::view('/fruits', 'fruits')->name('fruits');
Route::view('/electronics', 'electronics')->name('electronics');
Route::view('/personal-products', 'personal-products')->name('personal-products');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::view('/about', 'about')->name('about');

// ✅ Authentication Routes
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Forgot Password & OTP Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.email');

// OTP Verification Route
Route::get('otp-verify', [ResetPasswordController::class, 'showOtpForm'])->name('password.otp.form');
Route::post('otp-verify', [ResetPasswordController::class, 'verifyOtp'])->name('password.otp.verify');

// Password Reset Routes
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');


Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ✅ Email Verification Routes
Route::get('/email/verify', function () {
    // Pass the authenticated user to the view
    return view('email.verify', ['user' => Auth::user()]);
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
    
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place.order');
    
    // Coupon Routes
    Route::post('/coupon', [CheckoutController::class, 'applyCoupon'])->name('coupon.apply');
    Route::post('/coupon/remove', [CheckoutController::class, 'removeCoupon'])->name('coupon.remove');

    Route::get('/place-order', [PlaceOrderController::class, 'show'])->name('place-order');
    Route::get('/orders', [OrderController::class, 'userOrders'])->name('orders');
});

// ✅ Admin Routes
Route::prefix('admin')->middleware(['auth', 'verified', 'is.admin'])->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Resource routes for Products, Categories, Users, and Coupons
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('coupons', CouponController::class);
    
    // Contact Messages Route
    Route::get('/contact', [ContactMessageController::class, 'index'])->name('admin.contact');
    Route::delete('/contact/{message}', [ContactMessageController::class, 'destroy'])->name('admin.contact.destroy');

    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'create'])->name('notifications.create');
    Route::post('/notifications', [NotificationController::class, 'send'])->name('notifications.send');
});
