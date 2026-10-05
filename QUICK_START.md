# 🚀 Quick Start Guide - 5 Minutes to Running

**Abyzone CRUD System - Get Started Fast**

---

## ⚡ 5-Minute Setup

### 1. Configure Database (1 minute)
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=abyzone
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Generate Application Key (1 minute)
```bash
cd d:\xampp\htdocs\abyzone
php artisan key:generate
```

### 3. Run Migrations (1 minute)
```bash
php artisan migrate
```

### 4. Create Admin User (1 minute)
```bash
php artisan tinker
> User::create(['name' => 'Admin', 'email' => 'admin@test.com', 'password' => bcrypt('password'), 'role' => 'admin', 'status' => 1])
> exit
```

### 5. Start Server (1 minute)
```bash
php artisan serve
# Or access via XAMPP: http://localhost/abyzone
```

---

## 🔓 Default Login Credentials

| Role | Email | Password | URL |
|------|-------|----------|-----|
| Admin | admin@test.com | password | `/admin/dashboard` |
| Vendor* | (register) | (your password) | `/owner/dashboard` |
| Customer* | (register) | (your password) | `/user/dashboard` |

*Vendor and Customer: Register via `/register` page

---

## 📍 Quick Navigation

### Admin Area
- **Dashboard:** `http://localhost/abyzone/admin/dashboard`
- **Manage Users:** `http://localhost/abyzone/admin/users`
- **Manage Vendors:** `http://localhost/abyzone/admin/owners`
- **Manage Services:** `http://localhost/abyzone/admin/services`
- **Manage Bookings:** `http://localhost/abyzone/admin/bookings`
- **Manage Reviews:** `http://localhost/abyzone/admin/reviews`

### Vendor/Owner Area
- **Dashboard:** `http://localhost/abyzone/owner/dashboard`
- **My Services:** `http://localhost/abyzone/owner/services`
- **Business Profile:** `http://localhost/abyzone/owner/business-profile`
- **Payments:** `http://localhost/abyzone/owner/payments`

### Customer/User Area
- **Dashboard:** `http://localhost/abyzone/user/dashboard`
- **My Orders:** `http://localhost/abyzone/user/orders`
- **My Reviews:** `http://localhost/abyzone/user/reviews`
- **My Profile:** `http://localhost/abyzone/user/profile`

---

## ✨ What You Can Do

### As Admin
✅ Create, read, update, delete users  
✅ Manage vendors/owners  
✅ Manage all services  
✅ Update booking status  
✅ Delete reviews  
✅ View reports and analytics  

### As Vendor/Owner
✅ Manage own services  
✅ Update business profile  
✅ View payments  
✅ Track bookings  
✅ View customer reviews  

### As Customer/User
✅ Create orders  
✅ View order history  
✅ Create and manage reviews  
✅ Update profile  
✅ View wishlist and notifications  

---

## 🔧 Common Tasks

### Register New User
1. Go to `/register`
2. Fill in name, email, password
3. Select role: `customer` or `vendor`
4. Click register
5. Login with your credentials

### Create a Service (as Vendor)
1. Login as vendor
2. Go to `/owner/services`
3. Click "Create New Service"
4. Fill in service details
5. Click "Create"

### Create an Order (as Customer)
1. Login as customer
2. Go to `/user/orders`
3. Click "Create Order"
4. Select service and quantity
5. Click "Place Order"

### Write a Review (as Customer)
1. Login as customer
2. Go to `/user/reviews`
3. Click "Write Review"
4. Select service, rate, and comment
5. Click "Submit"

---

## 🆘 Troubleshooting

### "Database connection failed"
→ Check `.env` database credentials  
→ Ensure MySQL is running  
→ Run `php artisan migrate`

### "Routes not found (404)"
→ Run `php artisan route:clear`  
→ Run `php artisan cache:clear`

### "Can't login"
→ Check user exists: `php artisan tinker > User::all()`  
→ Verify password is correct  
→ Check user role is correct

### "Access denied (403)"
→ Check your user role  
→ Verify you're accessing correct area for your role  
→ Admin can access `/admin/*`  
→ Vendors can access `/owner/*`  
→ Customers can access `/user/*`

---

## 📚 Documentation

Detailed guides available:

1. **SETUP_TROUBLESHOOTING.md** - In-depth setup and troubleshooting
2. **CRUD_API_REFERENCE.md** - Complete API reference with all endpoints
3. **IMPLEMENTATION_STATUS.md** - Detailed feature list and status
4. **PROJECT_SUMMARY.md** - Project overview and highlights
5. **VERIFICATION_CHECKLIST.md** - Deployment checklist

---

## 🎯 Next Steps

1. **Customize Branding**
   - Edit header/footer in views
   - Update logo paths
   - Modify colors in CSS

2. **Add Sample Data**
   - Create services in admin area
   - Create test orders
   - Add reviews

3. **Configure Email** (Optional)
   - Set mail driver in `.env`
   - Configure SMTP settings
   - Send notifications

4. **Deploy to Production**
   - Follow deployment steps in SETUP_TROUBLESHOOTING.md
   - Configure server environment
   - Set proper file permissions
   - Enable HTTPS

---

## 💡 Pro Tips

✨ **Use Route Names for Links**
```blade
<a href="{{ route('admin.users.index') }}">Users</a>
<a href="{{ route('owner.services.index') }}">My Services</a>
<a href="{{ route('user.orders.index') }}">My Orders</a>
```

✨ **All Forms Include Validation**
- Invalid data won't submit
- Error messages display below each field
- Required fields are marked

✨ **Role-Based Redirects**
- Admin redirects to `/admin/dashboard`
- Vendor redirects to `/owner/dashboard`
- Customer redirects to `/user/dashboard`

✨ **One-Click Logout**
- Click user dropdown in header
- Click "Logout"
- Redirects to login page

---

## 📊 System Requirements

- PHP 8.1+
- MySQL 5.7+
- Composer
- Laravel 11.x
- Bootstrap 5
- Toastr.js

---

## 🎓 Learning Resources

- **Laravel Documentation:** https://laravel.com/docs/11.x
- **Blade Templating:** https://laravel.com/docs/11.x/blade
- **Eloquent ORM:** https://laravel.com/docs/11.x/eloquent
- **Bootstrap 5:** https://getbootstrap.com/docs/5.0

---

## 📞 Getting Help

1. **For Setup Issues:**
   → Check SETUP_TROUBLESHOOTING.md "Common Issues" section

2. **For API/Route Questions:**
   → See CRUD_API_REFERENCE.md

3. **For Feature Questions:**
   → Check IMPLEMENTATION_STATUS.md

4. **For General Help:**
   → Run `php artisan route:list` to see all routes
   → Run `php artisan tinker` to test database

---

## ✅ Verification

After setup, verify everything works:

```bash
# Check routes
php artisan route:list | grep admin

# Test database
php artisan tinker
> User::count()

# Clear cache if needed
php artisan cache:clear
php artisan route:clear
```

---

## 🎉 You're All Set!

Your Abyzone CRUD system is ready to use!

**Start with:**
1. Login as admin
2. Create a test vendor
3. Create a test service
4. Register as customer
5. Place an order
6. Write a review

---

**Questions?** See detailed documentation files  
**Ready to deploy?** Check SETUP_TROUBLESHOOTING.md deployment section  
**Need API reference?** See CRUD_API_REFERENCE.md  

---

*Time to launch: ~5 minutes ⚡*  
*Documentation: Comprehensive ✅*  
*Status: Ready to Go 🚀*
