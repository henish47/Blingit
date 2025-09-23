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
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\AiController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\InvoiceController; // <-- InvoiceController ne import karyo


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ------------------------
// Public Routes
// ------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{category:name}', [CategoryPageController::class, 'show'])->name('category.products');
Route::get('/product/{product:sku}', [ProductPageController::class, 'show'])->name('product.show');

Route::view('/milk', 'milk')->name('milk');
Route::view('/vegetables', 'vegetables')->name('vegetables');
Route::view('/fruits', 'fruits')->name('fruits');
Route::view('/electronics', 'electronics')->name('electronics');
Route::view('/personal-products', 'personal-products')->name('personal-products');
Route::view('/about', 'about')->name('about');

Route::get('/contact', fn() => view('contact'))->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/ai', fn() => view('ai'));
Route::post('/ai-suggest', [AiController::class, 'suggest'])->name('ai.suggest');

// ------------------------
// Authentication Routes
// ------------------------
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

// ------------------------
// Password Reset & OTP
// ------------------------
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.email');

Route::get('otp-verify', [ResetPasswordController::class, 'showOtpForm'])->name('password.otp.form');
Route::post('otp-verify', [ResetPasswordController::class, 'verifyOtp'])->name('password.otp.verify');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

// ------------------------
// Email Verification
// ------------------------
Route::middleware('auth')->group(function () {
    // Notice
    Route::get('/email/verify', function () {
        return view('email.verify', ['user' => Auth::user()]);
    })->name('verification.notice');

    // Resend verification
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', '📧 Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');
});

// Verification link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('login')->with('status', '✅ Email verified successfully. You can now login.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
    ->name('verification.verify')
    ->middleware('signed'); // remove 'auth' so it works even if logged out
    
// ------------------------
// Authenticated & Verified User Routes
// ------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Profile
    Route::get('/edit_profile', [UserProfileController::class, 'show'])->name('edit_profile');
    Route::patch('/edit_profile', [UserProfileController::class, 'update'])->name('profile.update');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place.order');
    Route::post('/coupon', [CheckoutController::class, 'applyCoupon'])->name('coupon.apply');
    Route::post('/coupon/remove', [CheckoutController::class, 'removeCoupon'])->name('coupon.remove');

    // Orders
    Route::get('/place-order/{order}', [CheckoutController::class, 'thankYou'])->name('place.order');
    Route::get('/orders', [OrderController::class, 'userOrders'])->name('orders');

    Route::get('/orders/{order}/invoice', [InvoiceController::class, 'generate'])->name('orders.invoice');
});

// ------------------------
// Admin Routes
// ------------------------
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'is.admin'])->group(function () {

    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Contact Messages
    Route::get('/contact', [ContactMessageController::class, 'index'])->name('contact');
    Route::delete('/contact/{message}', [ContactMessageController::class, 'destroy'])->name('contact.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'create'])->name('notifications.create');
    Route::post('/notifications', [NotificationController::class, 'send'])->name('notifications.send');

    // Resources
    Route::resources([
        'products' => ProductController::class,
        'categories' => CategoryController::class,
        'users' => UserController::class,
        'coupons' => CouponController::class,
        'banners' => BannerController::class,
    ]);
});
