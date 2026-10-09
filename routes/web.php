<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\Admin\PagesController as AdminPagesController;
use App\Http\Controllers\Admin\WarehouseController as AdminWarehouseController;
use App\Http\Controllers\Admin\BlogController  as AdminBlogController;
use App\Http\Controllers\Admin\WarehouseBookingController as AdminWarehouseBookingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\OwnerController as AdminOwnerController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\User\PagesController as UserPagesController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\ReviewController as UserReviewController;
use App\Http\Controllers\User\WarehouseBookingController as UserWarehouseBookingController;
use App\Http\Controllers\Owner\PagesController as OwnerPagesController;
use App\Http\Controllers\Owner\ServiceController as OwnerServiceController;
use App\Http\Controllers\Owner\WarehouseBookingController as OwnerWarehouseBookingController;
use App\Http\Controllers\Owner\BusinessProfileController as OwnerBusinessProfileController;
use App\Http\Controllers\Owner\PaymentController as OwnerPaymentController;
use App\Http\Controllers\Owner\WarehouseController as OwnerWarehouseController;
use App\Http\Controllers\User\WarehouseController as UserWarehouseController; 

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

Route::get('/', [PagesController::class, 'home'])->name('home');

// Public Pages Routes
Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/services', [PagesController::class, 'services'])->name('services');
Route::view('/terms-and-conditions', 'terms-and-conditions')->name('terms');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy.policy');
Route::post('/subscribe/store', [PagesController::class, 'subscribeStore'])->name('subscribe.store');
Route::get('/warehousing-detail', [PagesController::class, 'warehousingDetail'])->name('warehousing.detail');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact/store', [PagesController::class, 'contactStore'])->name('contact.store');
Route::get('/blog{category?}', [PagesController::class, 'blog'])->name('blog');
Route::get('/blog/search', [PagesController::class, 'search'])->name('blog.search');

Route::get('/blog-detail/{id}', [PagesController::class, 'blogDetail'])->name('blog.details');
Route::get('/explore', [PagesController::class, 'explore'])->name('explore');
Route::get('/warehouse/{slug}', [PagesController::class, 'warehouseDetail'])->name('warehouse.details');
Route::get('/service-detail/{slug}', [PagesController::class, 'serviceDetail'])->name('service.detail');
Route::post('/request-quote', [RequestController::class, 'storeQuote'])->name('request.quote');
Route::post('/request-meeting', [RequestController::class, 'storeMeeting'])->name('request.meeting');
// Auth routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');

Route::get('auth/google', [AuthController::class, 'redirect'])->name('google.login');
Route::get('google/role/form', [AuthController::class, 'showRoleForm'])->name('google.role.form');
Route::post('/auth/google/role', [AuthController::class, 'saveRole'])->name('google.role.save');
Route::get('auth/google/callback', [AuthController::class, 'callback'])->name('google.callback');
Route::get('auth-google-callback', [AuthController::class, 'callback'])->name('google.callback');

// Login routes (primary names: `login` / `login.post`)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Backwards-compatible route names used elsewhere in the app
// These provide the older `auth.login` / `auth.login.post` names without
// changing existing views/controllers. The GET route redirects to the
// canonical `/login` URL; the POST route maps to the same controller.
Route::get('/auth-login', function () {
    return redirect()->route('login');
})->name('auth.login');

Route::post('/auth-login', [AuthController::class, 'login'])->name('auth.login.post');

Route::get('/otp', [AuthController::class, 'showOtp'])->name('auth.otp');
Route::post('/otp', [AuthController::class, 'postOtp'])->name('auth.otp.post');
Route::get('/otp/resend', [AuthController::class, 'resendOtp'])->name('auth.otp.resend');

Route::get('/forgot', [AuthController::class, 'showForgot'])->name('auth.forgot');
Route::post('/forgot', [AuthController::class, 'postForgot'])->name('auth.forgot.post');

Route::get('/forgot-otp', [AuthController::class, 'showForgotOtp'])->name('auth.forgot.otp');
Route::post('/forgot-otp', [AuthController::class, 'postForgotOtp'])->name('auth.forgot.otp.post');
Route::get('/forgot-otp/resend', [AuthController::class, 'resendForgotOtp'])->name('auth.forgot.otp.resend');

Route::get('/reset', [AuthController::class, 'showReset'])->name('auth.reset');
Route::post('/reset', [AuthController::class, 'postReset'])->name('auth.reset.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Admin-specific login/logout (uses admin guard/provider)
Route::get('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

// ============================================================
// ADMIN ROUTES
// ============================================================
    // Admin routes authenticate with the `admin` guard only (single admin account)
Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [AdminPagesController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminPagesController::class, 'users'])->name('users');
    
    Route::get('/inquiry', [AdminPagesController::class, 'inquiry'])->name('inquiry');
    Route::get('/subscriber', [AdminPagesController::class, 'subscribe'])->name('subscribe');
    Route::get('/notification', [AdminPagesController::class, 'notification'])->name('notification');
    Route::post('/notification/mark-read', [AdminPagesController::class, 'markAsRead'])->name('notification.markRead');
    Route::get('/quote-request', [AdminPagesController::class, 'quote'])->name('quote.request');
    Route::get('/meeting-request', [AdminPagesController::class, 'meeting'])->name('meeting.request');
    // Admin resource routes for user management
    Route::resource('users', AdminUserController::class)->names([
        'index' => 'users',
        'create' => 'users.create',
        'store' => 'users.store',
        'show' => 'users.show',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);
    // Admin owners (vendors) resource routes
    Route::resource('owners', AdminOwnerController::class)->names([
        'index' => 'owners',
        'create' => 'owners.create',
        'store' => 'owners.store',
        'show' => 'owners.show',
        'edit' => 'owners.edit',
        'update' => 'owners.update',
        'destroy' => 'owners.destroy',
    ]);
    // Admin services resource routes
    Route::resource('services', AdminServiceController::class)->names([
        'index' => 'services',
        'create' => 'services.create',
        'store' => 'services.store',
        'show' => 'services.show',
        'edit' => 'services.edit',
        'update' => 'services.update',
        'destroy' => 'services.destroy',
    ]);

    // Admin categories resource routes
    Route::resource('category', AdminCategoryController::class)->names([
        'index' => 'category',
        'create' => 'category.create',
        'store' => 'category.store',
        'show' => 'category.show',
        'edit' => 'category.edit',
        'update' => 'category.update',
        'destroy' => 'category.destroy',
    ]);
    
    // Admin blogs resource routes
    Route::resource('blog', AdminBlogController::class)->names([
        'index' => 'blog',
        'create' => 'blog.create',
        'store' => 'blog.store',
        'show' => 'blog.show',
        'edit' => 'blog.edit',
        'update' => 'blog.update',
        'destroy' => 'blog.destroy',
    ]);

    // Admin warehouses resource routes
    Route::resource('warehouses', AdminWarehouseController::class)->names([
        'index' => 'warehouses',
        'create' => 'warehouses.create',
        'store' => 'warehouses.store',
        'show' => 'warehouses.show',
        'edit' => 'warehouses.edit',
        'update' => 'warehouses.update',
        'destroy' => 'warehouses.destroy',
    ]);

    // Admin warehouses Booking resource routes
      Route::resource('warehouse-bookings', AdminWarehouseBookingController::class)->only(['index', 'show', 'update'])->names([
        'index' => 'warehouse-bookings.index',
        'show' => 'warehouse-bookings.show',
        'update' => 'warehouse-bookings.update',
    ]);
    
    // Admin bookings resource routes  
    Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'update', 'destroy'])->names([
        'index' => 'bookings',
        'show' => 'bookings.show',
        'update' => 'bookings.update',
        'destroy' => 'bookings.destroy',
    ]);
    // Admin reviews resource routes
    Route::resource('reviews', AdminReviewController::class)->only(['index', 'show', 'destroy'])->names([
        'index' => 'reviews',
        'show' => 'reviews.show',
        'destroy' => 'reviews.destroy',
    ]);
    Route::get('/reports', [AdminPagesController::class, 'reports'])->name('reports');
    Route::get('/settings', [AdminPagesController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminPagesController::class, 'updateSettings'])->name('settings.update');
});

// ============================================================
// USER ROUTES
// ============================================================
Route::prefix('user')->name('user.')->middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', [UserPagesController::class, 'index'])->name('dashboard');
    
    // User profile routes
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    
    // user orders resource
    Route::resource('orders', UserOrderController::class)->only(['index','create','store','show'])->names([
        'index' => 'orders',
        'create' => 'orders.create',
        'store' => 'orders.store',
        'show' => 'orders.show',
    ]);
    
    // User reviews resource
    Route::resource('reviews', UserReviewController::class)->names([
        'index' => 'reviews',
        'create' => 'reviews.create',
        'store' => 'reviews.store',
        'show' => 'reviews.show',
        'edit' => 'reviews.edit',
        'update' => 'reviews.update',
        'destroy' => 'reviews.destroy',
    ]);
    
    Route::get('/wishlist', [UserPagesController::class, 'wishlist'])->name('wishlist');
    Route::get('/notifications', [UserPagesController::class, 'notifications'])->name('notifications');
    Route::get('/notifications/mark-all-read', function() {
        \App\Models\Notification::forUser(auth()->id(), 'user')->unread()->update(['is_read' => true]);
        return back()->with('success', 'All notifications marked as read');
    })->name('notifications.mark-all-read');
    Route::post('/notifications/{id}/mark-read', [UserPagesController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::delete('/notifications/{id}', [UserPagesController::class, 'deleteNotification'])->name('notifications.delete');
    Route::get('/notifications/mark-all-read', function() {
        \App\Models\Notification::forUser(auth()->id(), 'user')->unread()->update(['is_read' => true]);
        return back()->with('success', 'All notifications marked as read');
    })->name('notifications.mark-all-read');
    Route::post('/notifications/{id}/mark-read', [UserPagesController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::delete('/notifications/{id}', [UserPagesController::class, 'deleteNotification'])->name('notifications.delete');
    Route::get('/notifications/mark-all-read', function() {
        \App\Models\Notification::forUser(auth()->id(), 'user')->unread()->update(['is_read' => true]);
        return back()->with('success', 'All notifications marked as read');
    })->name('notifications.mark-all-read');
    Route::post('/notifications/{id}/mark-read', [UserPagesController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::delete('/notifications/{id}', [UserPagesController::class, 'deleteNotification'])->name('notifications.delete');
    Route::get('/support', [UserPagesController::class, 'support'])->name('support');

    // Warehouses discovery & booking flow
    Route::get('/warehouses', [UserWarehouseController::class, 'index'])->name('warehouses.index');
    Route::get('/warehouses/{warehouse:slug}', [UserWarehouseController::class, 'show'])->name('warehouses.show');
    Route::post('/warehouses/{warehouse:slug}/book', [UserWarehouseController::class, 'book'])->name('warehouses.book');
    Route::get('/warehouse-requests', [UserWarehouseBookingController::class, 'index'])->name('warehouses.requests');
});

// ============================================================
// OWNER ROUTES
// ============================================================
Route::prefix('owner')->name('owner.')->middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/dashboard', [OwnerPagesController::class, 'index'])->name('dashboard');
    
    // Owner business profile routes
    Route::get('/business-profile', [OwnerBusinessProfileController::class, 'show'])->name('business.profile');
    Route::get('/business-profile/edit', [OwnerBusinessProfileController::class, 'edit'])->name('business.profile.edit');
    Route::put('/business-profile', [OwnerBusinessProfileController::class, 'update'])->name('business.profile.update');
    
    // owner services resource
    Route::resource('services', OwnerServiceController::class)->names([
        'index' => 'services.index',
        'create' => 'services.create',
        'store' => 'services.store',
        'show' => 'services.show',
        'edit' => 'services.edit',
        'update' => 'services.update',
        'destroy' => 'services.destroy',
    ]);

    Route::resource('warehouses', OwnerWarehouseController::class)->names([
        'index' => 'warehouses.index',
        'create' => 'warehouses.create',
        'store' => 'warehouses.store',
        'show' => 'warehouses.show',
        'edit' => 'warehouses.edit',
        'update' => 'warehouses.update',
        'destroy' => 'warehouses.destroy',
    ]);

    Route::resource('warehouse-bookings', OwnerWarehouseBookingController::class)->only(['index', 'show', 'update'])->names([
        'index' => 'warehouse-bookings.index',
        'show' => 'warehouse-bookings.show',
        'update' => 'warehouse-bookings.update',
    ]);
    
    // Owner payments resource
    Route::resource('payments', OwnerPaymentController::class)->only(['index', 'show'])->names([
        'index' => 'payments',
        'show' => 'payments.show',
    ]);
    Route::get('/notifications', [OwnerPagesController::class, 'notifications'])->name('notifications');
    Route::get('/notifications/mark-all-read', function() {
        \App\Models\Notification::forUser(auth()->id(), 'owner')->unread()->update(['is_read' => true]);
        return back()->with('success', 'All notifications marked as read');
    })->name('notifications.mark-all-read');
    Route::post('/notifications/{id}/mark-read', [OwnerPagesController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::delete('/notifications/{id}', [OwnerPagesController::class, 'deleteNotification'])->name('notifications.delete');
    Route::get('/notifications/mark-all-read', function() {
        \App\Models\Notification::forUser(auth()->id(), 'owner')->unread()->update(['is_read' => true]);
        return back()->with('success', 'All notifications marked as read');
    })->name('notifications.mark-all-read');
    Route::post('/notifications/{id}/mark-read', [OwnerPagesController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::delete('/notifications/{id}', [OwnerPagesController::class, 'deleteNotification'])->name('notifications.delete');
});
