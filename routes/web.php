<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ZendeskController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CreativeController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SubuserAuthController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Admin\SubuserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\SuperAdmin\PlanController;
use App\Http\Controllers\SuperAdmin\ActivityController;
use App\Http\Controllers\SuperAdmin\DownloadController;
use App\Http\Controllers\Auth\SubuserAuthenticatedSessionController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/text-generate', [HomeController::class, 'textGenerate'])->name('text.generate');

Route::post('/support/submit', [ZendeskController::class, 'submit'])->name('zendesk.submit');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/creative', [CreativeController::class, 'create'])->name('dashboard');
    Route::get('/support', [ZendeskController::class, 'index'])->name('supoprt');

    Route::post('/checkout/{plan_id}', [HomeController::class, 'checkout'])->name('checkout');
    Route::get('/payment-success', [HomeController::class, 'success'])->name('payment.success');
    Route::get('/payment-cancel', [HomeController::class, 'cancel'])->name('payment.cancel');
    Route::get('/creative/show/{id}', [CarouselController::class, 'show'])->name('carousel.show');

});
Route::middleware(['auth', 'verified', 'role:1'])->group(function () {
    Route::post("/creative", [CreativeController::class, 'store'])->name('creative.store');
    Route::post("/creative/generate-video", [CreativeController::class, 'generateVideo'])->name('creative.generate-video');    
    Route::get("/creative/get-credits", [CreativeController::class, 'getCredits'])->name('creative.get-credits');
    // Route::get('/creative/video-status/{videoId}', [CreativeController::class, 'getVideoStatus']);
    Route::get('/creative/list', [CreativeController::class, 'index'])->name('creative.index');
    Route::delete('/creative/{id}', [CreativeController::class, 'destroy'])->name('creative.destroy');
    Route::post('/ai/imagegenerate', [CreativeController::class, 'generateAiImages'])->name('ai.imagegenerate');

    Route::get('/users/list', [AdminController::class, 'allUsers'])->name('admin.users');
    Route::post('/admin/change-status/{id}', [AdminController::class, 'Status'])->name('admin.change.status');

    Route::resource('subusers', SubuserController::class);
    Route::put('subusers/{subuser}/toggle-status', [SubuserController::class, 'toggleStatus'])->name('subusers.toggle-status');

    Route::get('/customer/download/count', [AdminController::class, 'userDownloadCount'])->name('user.creative-downloads');
    Route::get('/customer/download/history', [AdminController::class, 'downloadHistory'])->name('user.download-history');
    Route::post('/customer/track-download', [AdminController::class, 'trackDownload'])->name('track.download');

    Route::get('/billing', [BillingController::class, 'overview'])->name('billing.overview');
    Route::post('/billing/subscription/cancel', [BillingController::class, 'cancel'])->name('billing.subscription.cancel');
    Route::post('/billing/subscription/resume', [BillingController::class, 'resume'])->name('billing.subscription.resume');
    
});

Route::middleware(['auth', 'verified', 'role:2'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/change-status/{id}', [SuperAdminController::class, 'changeStatus'])->name('change.status');
    Route::get('/creatives/list', [SuperAdminController::class, 'allCreatives'])->name('superadmin.creative');
    Route::prefix('admin')->group(function () {
        Route::resource('promocodes', PromoCodeController::class);
        Route::post('/promocodes/{promoCode}/toggle-active', [PromoCodeController::class, 'toggleActive'])->name('promocodes.toggle-active');
        Route::resource('plans', PlanController::class);
        Route::get('/downloads', [DownloadController::class, 'downloadHistory'])->name('customer.downloads');
    });
    Route::post('/plans/{plan}/toggle-active', [PlanController::class, 'toggleActive'])->name('plans.toggle-active');
    Route::resource('subscriptions', SubscriptionController::class);
    Route::patch('/subscriptions/{subscription}/cancel', [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');
    Route::patch('/subscriptions/{subscription}/renew', [SubscriptionController::class, 'renew'])->name('subscriptions.renew');
    Route::get('/customer/activities', [SuperAdminController::class, 'cutomerActivities'])->name('customer.activities');
    Route::get('/customer/activities/show/{id}', [SuperAdminController::class, 'customerDetails'])->name('customer.activities.show');

    Route::get('/admin/payment-logs', [SuperAdminController::class, 'paymentLogs'])->name('payment.logs');

     Route::prefix('admin')->group(function () {
        Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
        Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');
        Route::get('/activities/analytics', [ActivityController::class, 'analytics'])->name('activities.analytics');
        Route::get('/activities/export', [ActivityController::class, 'export'])->name('activities.export');
        Route::get('/activities/live-feed', [ActivityController::class, 'liveFeed'])->name('activities.live-feed');
    });
});

// Profile routes - requires email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Subuser protected routes
Route::middleware(['subuser'])->prefix('subuser')->group(function () {
    Route::post('logout', [SubuserAuthController::class, 'logout'])->name('subuser.logout');
    Route::get('dashboard', function () {
        return view('subuser.dashboard');
    })->name('subuser.dashboard');
});
// Subuser authentication routes
Route::prefix('subuser')->group(function () {
    Route::middleware('guest:subuser')->group(function () {
        Route::get('login', [SubuserAuthenticatedSessionController::class, 'create'])->name('subuser.login');
        Route::post('login', [SubuserAuthenticatedSessionController::class, 'store']);
    });

});


require __DIR__ . '/auth.php';
