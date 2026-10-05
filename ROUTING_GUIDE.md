# Abyzone Project - Routing & Controller Setup

## Project Structure Created

### Controller Folders
```
app/Http/Controllers/
├── Admin/
│   └── PagesController.php
├── User/
│   └── PagesController.php
├── Owner/
│   └── PagesController.php
├── AuthController.php
├── Controller.php
└── PagesController.php (Public Pages)
```

---

## Routes Summary

### Public Pages Routes
```
GET  /                    → Welcome Page
GET  /home               → Home Page
GET  /about              → About Page
GET  /services           → Services Page
GET  /warehousing-detail → Warehousing Details
GET  /contact            → Contact Page
GET  /blog               → Blog Page
GET  /blog-detail        → Blog Details
GET  /explore            → Explore Page
GET  /service-detail     → Service Details
```

### Authentication Routes
```
GET  /register           → Show Registration Form
POST /register           → Process Registration
GET  /login              → Show Login Form
POST /login              → Process Login
GET  /otp                → Show OTP Form
POST /otp                → Verify OTP
POST /otp/resend         → Resend OTP
GET  /forgot             → Show Forgot Password Form
POST /forgot             → Process Forgot Password
GET  /forgot-otp         → Show Forgot OTP Form
POST /forgot-otp         → Verify Forgot OTP
POST /forgot-otp/resend  → Resend Forgot OTP
GET  /reset              → Show Reset Password Form
POST /reset              → Process Reset Password
POST /logout             → Logout User
```

---

## Admin Routes (`/admin/`)

**Route Prefix:** `admin`  
**Name Prefix:** `admin.`

| Route | Method | Controller | Name | View |
|-------|--------|-----------|------|------|
| `/admin/dashboard` | GET | `Admin\PagesController@index` | `admin.dashboard` | `admin.index` |
| `/admin/users` | GET | `Admin\PagesController@users` | `admin.users` | `admin.user` |
| `/admin/owners` | GET | `Admin\PagesController@owners` | `admin.owners` | `admin.owner` |
| `/admin/services` | GET | `Admin\PagesController@services` | `admin.services` | `admin.services` |
| `/admin/bookings` | GET | `Admin\PagesController@bookings` | `admin.bookings` | `admin.booking` |
| `/admin/reviews` | GET | `Admin\PagesController@reviews` | `admin.reviews` | `admin.review` |
| `/admin/reports` | GET | `Admin\PagesController@reports` | `admin.reports` | `admin.report` |
| `/admin/settings` | GET | `Admin\PagesController@settings` | `admin.settings` | `admin.settings` |

### Using Admin Routes in Blade Templates:
```blade
<!-- Link to Admin Dashboard -->
<a href="{{ route('admin.dashboard') }}">Dashboard</a>

<!-- Link to Manage Users -->
<a href="{{ route('admin.users') }}">Manage Users</a>

<!-- Link to Manage Owners -->
<a href="{{ route('admin.owners') }}">Manage Owners</a>

<!-- Link to Manage Services -->
<a href="{{ route('admin.services') }}">Manage Services</a>
```

---

## User Routes (`/user/`)

**Route Prefix:** `user`  
**Name Prefix:** `user.`

| Route | Method | Controller | Name | View |
|-------|--------|-----------|------|------|
| `/user/dashboard` | GET | `User\PagesController@index` | `user.dashboard` | `user.index` |
| `/user/profile` | GET | `User\PagesController@profile` | `user.profile` | `user.profile` |
| `/user/orders` | GET | `User\PagesController@orders` | `user.orders` | `user.my-orders` |
| `/user/wishlist` | GET | `User\PagesController@wishlist` | `user.wishlist` | `user.wishlist` |
| `/user/reviews` | GET | `User\PagesController@reviews` | `user.reviews` | `user.reviews` |
| `/user/notifications` | GET | `User\PagesController@notifications` | `user.notifications` | `user.notifications` |
| `/user/support` | GET | `User\PagesController@support` | `user.support` | `user.support` |

### Using User Routes in Blade Templates:
```blade
<!-- Link to User Dashboard -->
<a href="{{ route('user.dashboard') }}">My Dashboard</a>

<!-- Link to User Profile -->
<a href="{{ route('user.profile') }}">My Profile</a>

<!-- Link to My Orders -->
<a href="{{ route('user.orders') }}">My Orders</a>

<!-- Link to Wishlist -->
<a href="{{ route('user.wishlist') }}">My Wishlist</a>
```

---

## Owner Routes (`/owner/`)

**Route Prefix:** `owner`  
**Name Prefix:** `owner.`

| Route | Method | Controller | Name | View |
|-------|--------|-----------|------|------|
| `/owner/dashboard` | GET | `Owner\PagesController@index` | `owner.dashboard` | `owner.index` |
| `/owner/business-profile` | GET | `Owner\PagesController@businessProfile` | `owner.business.profile` | `owner.business-profile` |
| `/owner/properties` | GET | `Owner\PagesController@properties` | `owner.properties` | `owner.property` |
| `/owner/bookings` | GET | `Owner\PagesController@bookings` | `owner.bookings` | `owner.booking` |
| `/owner/pricing-availability` | GET | `Owner\PagesController@pricingAvailability` | `owner.pricing.availability` | `owner.pricing-and-availability` |
| `/owner/reviews` | GET | `Owner\PagesController@reviews` | `owner.reviews` | `owner.reviews` |
| `/owner/analytics` | GET | `Owner\PagesController@analytics` | `owner.analytics` | `owner.analytics` |
| `/owner/payments` | GET | `Owner\PagesController@payments` | `owner.payments` | `owner.payments` |
| `/owner/notifications` | GET | `Owner\PagesController@notifications` | `owner.notifications` | `owner.notifications` |
| `/owner/reports` | GET | `Owner\PagesController@reports` | `owner.reports` | `owner.report` |

### Using Owner Routes in Blade Templates:
```blade
<!-- Link to Owner Dashboard -->
<a href="{{ route('owner.dashboard') }}">Dashboard</a>

<!-- Link to Business Profile -->
<a href="{{ route('owner.business.profile') }}">Business Profile</a>

<!-- Link to Properties -->
<a href="{{ route('owner.properties') }}">My Properties</a>

<!-- Link to Pricing & Availability -->
<a href="{{ route('owner.pricing.availability') }}">Pricing & Availability</a>
```

---

## Example Usage in Controllers

### Redirect to Admin Dashboard:
```php
return redirect()->route('admin.dashboard');
```

### Redirect to User Dashboard:
```php
return redirect()->route('user.dashboard');
```

### Redirect to Owner Dashboard:
```php
return redirect()->route('owner.dashboard');
```

---

## Additional Notes

✅ **Setup Complete!**
- All controller folders created with proper namespaces
- All routes configured with prefixes and route names
- Views are already organized in separate folders (admin, user, owner)
- Controllers follow Laravel best practices with documentation

**Next Steps:**
1. Add middleware to protect routes (auth, admin, owner, user roles)
2. Create an Admin middleware to check user role
3. Create models and relationships for User, Admin, Owner roles
4. Implement route protection in RouteServiceProvider or middleware

### Recommended Middleware Addition:
```php
// In routes/web.php, wrap routes with middleware
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // admin routes
});

Route::prefix('user')->name('user.')->middleware(['auth', 'user'])->group(function () {
    // user routes
});

Route::prefix('owner')->name('owner.')->middleware(['auth', 'owner'])->group(function () {
    // owner routes
});
```

