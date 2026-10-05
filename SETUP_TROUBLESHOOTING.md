# Setup & Troubleshooting Guide

## 🚀 Initial Setup Steps

### Step 1: Database Configuration
1. Open `.env` file
2. Configure database connection:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=abyzone
DB_USERNAME=root
DB_PASSWORD=
```

### Step 2: Generate Application Key
```bash
php artisan key:generate
```

### Step 3: Create Database
```bash
# Option 1: Using artisan (if migration exists)
php artisan migrate

# Option 2: Manual SQL
CREATE DATABASE abyzone;
```

### Step 4: Create Admin User

Run tinker:
```bash
php artisan tinker
```

Then execute:
```php
App\Models\User::create([
    'name' => 'Administrator',
    'email' => 'admin@abyzone.com',
    'password' => bcrypt('admin123456'),
    'role' => 'admin',
    'status' => 1
]);
```

### Step 5: Test Access
- Admin URL: `http://localhost/abyzone/admin/dashboard`
- Email: `admin@abyzone.com`
- Password: `admin123456`

---

## 🔧 Common Issues & Solutions

### Issue 1: "Route Not Found" Error
**Symptom:** 404 error when accessing any route
**Solutions:**
1. Clear route cache:
```bash
php artisan route:clear
php artisan route:cache
```
2. Verify routes file has no syntax errors:
```bash
php artisan route:list | grep admin
```
3. Check base URL in `.env`:
```env
APP_URL=http://localhost/abyzone
```

### Issue 2: "Class Not Found" Error
**Symptom:** `Class 'App\Http\Controllers\Admin\UserController' not found`
**Solutions:**
1. Verify controller file exists in correct location
2. Check namespace in controller file:
```php
<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
```
3. Run composer autoload:
```bash
composer dump-autoload
```

### Issue 3: "Middleware Not Found"
**Symptom:** `MethodNotAllowedHttpException` or middleware not running
**Solutions:**
1. Verify middleware is registered in `app/Http/Kernel.php`:
```php
protected $routeMiddleware = [
    'role' => \App\Http\Middleware\CheckRole::class,
];
```
2. Clear middleware cache:
```bash
php artisan config:clear
```
3. Verify middleware file exists at correct path

### Issue 4: CSRF Token Mismatch
**Symptom:** "419 Page Expired" or CSRF token error on form submission
**Solutions:**
1. Ensure form includes CSRF token:
```blade
<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <!-- form fields -->
</form>
```
2. Check session configuration in `.env`:
```env
SESSION_DRIVER=file
```
3. Clear session storage:
```bash
rm -rf storage/framework/sessions/*
```

### Issue 5: Authentication Not Working
**Symptom:** Can't login or session not persisting
**Solutions:**
1. Check auth configuration in `config/auth.php`
2. Verify User model uses `Authenticatable` trait
3. Clear authentication cache:
```bash
php artisan cache:clear
php artisan auth:clear-resets
```
4. Check database for user record:
```bash
php artisan tinker
> User::all()
```

### Issue 6: Authorization/Role Check Failing
**Symptom:** "Unauthorized" error even with correct role
**Solutions:**
1. Verify user has correct role in database:
```bash
php artisan tinker
> User::find(1)->role
```
2. Check role value matches middleware configuration
3. Verify CheckRole middleware logic:
```php
public function handle($request, Closure $next, ...$roles)
{
    if (!auth()->check() || !in_array(auth()->user()->role, $roles)) {
        abort(403);
    }
    return $next($request);
}
```

### Issue 7: Form Validation Errors Not Displaying
**Symptom:** Validation errors occur but don't show in form
**Solutions:**
1. Ensure view includes error display:
```blade
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```
2. Check per-field error display:
```blade
@error('email')
    <span class="invalid-feedback">{{ $message }}</span>
@enderror
```
3. Ensure form method is POST/PUT with @csrf token

### Issue 8: Redirect Loop
**Symptom:** Infinite redirect between login and dashboard
**Solutions:**
1. Check if user has correct role
2. Verify middleware is not accidentally redirecting
3. Check if login route is excluded from auth middleware:
```php
// Should NOT have auth middleware
Route::post('/login', [AuthController::class, 'login']);
```

### Issue 9: Database Connection Error
**Symptom:** "SQLSTATE[HY000]" or connection refused
**Solutions:**
1. Verify database server is running (MySQL/MariaDB)
2. Check `.env` database credentials
3. Verify database exists
4. Test connection:
```bash
php artisan tinker
> DB::connection()->getPdo()
```

### Issue 10: File Permissions Error
**Symptom:** "Permission denied" writing to storage/logs
**Solutions:**
1. Set storage directory permissions:
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```
2. Set owner to web server user:
```bash
chown -R www-data:www-data storage bootstrap/cache
```

---

## 📋 Pre-Launch Checklist

- [ ] `.env` file configured with database credentials
- [ ] `APP_KEY` generated (`php artisan key:generate`)
- [ ] Database created and migrations run
- [ ] Admin user created
- [ ] Middleware registered in `Kernel.php`
- [ ] All controllers namespaced correctly
- [ ] All views exist in correct directories
- [ ] Routes file has no syntax errors
- [ ] Session storage writable
- [ ] Logs directory writable
- [ ] Bootstrap cache directory writable
- [ ] CSRF tokens in all forms
- [ ] Authentication redirects working
- [ ] Role-based access control functioning
- [ ] Error messages displaying correctly
- [ ] Flash messages displaying with Toastr

---

## 🧪 Testing Procedures

### Test Admin Access
1. Login with admin credentials
2. Navigate to `/admin/dashboard`
3. Verify dashboard loads
4. Test each CRUD section:
   - Create user → Read → Update → Delete
   - Create vendor → Read → Update → Delete
   - Create service → Read → Update → Delete
5. Try accessing owner routes (should get 403)
6. Try accessing user routes (should get 403)

### Test Owner Access
1. Register new account with vendor role
2. Login and navigate to `/owner/dashboard`
3. Verify dashboard loads
4. Test CRUD:
   - Create service → Read → Update → Delete
   - View business profile → Edit → Update
   - View payments
5. Try accessing admin routes (should get 403)
6. Try accessing user routes (should get 403)

### Test User Access
1. Register new account with customer role
2. Login and navigate to `/user/dashboard`
3. Verify dashboard loads
4. Test CRUD:
   - Create order → Read
   - Create review → Read → Update → Delete
   - View profile → Edit → Update
5. Try accessing admin routes (should get 403)
6. Try accessing owner routes (should get 403)

### Test Form Validation
1. Submit empty forms → verify error display
2. Submit with invalid email → verify validation
3. Submit with short password → verify validation
4. Submit valid data → verify success message

### Test Error Handling
1. Try accessing non-existent resource (`/admin/users/9999`)
2. Verify 404 error displays
3. Try deleting resource → verify confirmation
4. Try editing locked/deleted resource

---

## 📊 Debugging Commands

### View All Routes
```bash
php artisan route:list
php artisan route:list | grep admin
php artisan route:list | grep owner
php artisan route:list | grep user
```

### Clear All Caches
```bash
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear
```

### Check Configuration
```bash
php artisan config:show
php artisan config:show auth
```

### Database Debugging
```bash
# List all tables
php artisan tinker
> Schema::getTables()

# Check user table
> User::all()
> User::first()

# Create test user
> User::create(['name'=>'Test','email'=>'test@test.com','password'=>bcrypt('password'),'role'=>'customer'])
```

### Enable Debug Mode
In `.env`:
```env
APP_DEBUG=true
```

This shows detailed error messages and stack traces.

### View Logs
```bash
tail -f storage/logs/laravel.log
```

---

## 🔒 Security Checklist

- [ ] APP_DEBUG set to false in production
- [ ] APP_KEY configured
- [ ] Database credentials secure (not in .env.example)
- [ ] CSRF protection enabled
- [ ] SQL injection prevention (using Eloquent ORM)
- [ ] XSS prevention (Blade escaping)
- [ ] Password hashing implemented
- [ ] Role-based access control enforced
- [ ] Sensitive data not logged
- [ ] HTTPS enforced in production

---

## 📦 Deployment Steps

### 1. Prepare Server
```bash
# SSH into server
ssh user@server.com

# Install dependencies
composer install --no-dev --optimize-autoloader

# Generate key
php artisan key:generate
```

### 2. Configure Environment
```bash
# Copy .env and configure
cp .env.example .env
nano .env  # Edit with production values
```

### 3. Run Migrations
```bash
php artisan migrate --force
```

### 4. Create Admin User
```bash
php artisan tinker
> User::create([...])
```

### 5. Optimize
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. Set Permissions
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

## 📞 Support Resources

### Laravel Documentation
- Routes: https://laravel.com/docs/11.x/routing
- Controllers: https://laravel.com/docs/11.x/controllers
- Authentication: https://laravel.com/docs/11.x/authentication
- Authorization: https://laravel.com/docs/11.x/authorization
- Middleware: https://laravel.com/docs/11.x/middleware

### Common Commands
```bash
# Create new controller
php artisan make:controller ControllerName

# Create new model
php artisan make:model ModelName

# Create new migration
php artisan make:migration create_table_name

# List all artisan commands
php artisan list
```

---

**Last Updated:** Current Session  
**Status:** Complete ✅
