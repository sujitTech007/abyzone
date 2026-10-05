# Abyzone CRUD API Reference Guide

## Authentication Routes

### Login
- **Route:** `POST /login`
- **Form Fields:** `email`, `password`
- **Redirect:** Dashboard based on user role

### Register
- **Route:** `POST /register`
- **Form Fields:** `name`, `email`, `password`, `password_confirmation`, `role` (customer/vendor)
- **Default Role:** customer
- **Auto-set:** `status = 1`, `role` based on form input

### Logout
- **Route:** `POST /logout`
- **Middleware:** `auth`

---

## Admin API (`/admin/*`)

### Users Management
| Method | Route | Action | Name | Controller Method |
|--------|-------|--------|------|------------------|
| GET | `/admin/users` | List all users | `admin.users.index` | `index()` |
| GET | `/admin/users/create` | Show create form | `admin.users.create` | `create()` |
| POST | `/admin/users` | Store new user | `admin.users.store` | `store()` |
| GET | `/admin/users/{id}` | Show user details | `admin.users.show` | `show($id)` |
| GET | `/admin/users/{id}/edit` | Show edit form | `admin.users.edit` | `edit($id)` |
| PUT/PATCH | `/admin/users/{id}` | Update user | `admin.users.update` | `update(Request $request, $id)` |
| DELETE | `/admin/users/{id}` | Delete user | `admin.users.destroy` | `destroy($id)` |

### Owners (Vendors) Management
| Method | Route | Action | Name | Controller Method |
|--------|-------|--------|------|------------------|
| GET | `/admin/owners` | List all vendors | `admin.owners.index` | `index()` |
| GET | `/admin/owners/create` | Show create form | `admin.owners.create` | `create()` |
| POST | `/admin/owners` | Store new vendor | `admin.owners.store` | `store()` |
| GET | `/admin/owners/{id}` | Show vendor details | `admin.owners.show` | `show($id)` |
| GET | `/admin/owners/{id}/edit` | Show edit form | `admin.owners.edit` | `edit($id)` |
| PUT/PATCH | `/admin/owners/{id}` | Update vendor | `admin.owners.update` | `update(Request $request, $id)` |
| DELETE | `/admin/owners/{id}` | Delete vendor | `admin.owners.destroy` | `destroy($id)` |

### Services Management
| Method | Route | Action | Name | Controller Method |
|--------|-------|--------|------|------------------|
| GET | `/admin/services` | List all services | `admin.services.index` | `index()` |
| GET | `/admin/services/create` | Show create form | `admin.services.create` | `create()` |
| POST | `/admin/services` | Store new service | `admin.services.store` | `store()` |
| GET | `/admin/services/{id}` | Show service details | `admin.services.show` | `show($id)` |
| GET | `/admin/services/{id}/edit` | Show edit form | `admin.services.edit` | `edit($id)` |
| PUT/PATCH | `/admin/services/{id}` | Update service | `admin.services.update` | `update(Request $request, $id)` |
| DELETE | `/admin/services/{id}` | Delete service | `admin.services.destroy` | `destroy($id)` |

### Bookings/Orders Management
| Method | Route | Action | Name | Controller Method |
|--------|-------|--------|------|------------------|
| GET | `/admin/bookings` | List all bookings | `admin.bookings.index` | `index()` |
| GET | `/admin/bookings/{id}` | Show booking details | `admin.bookings.show` | `show($id)` |
| PUT/PATCH | `/admin/bookings/{id}` | Update booking status | `admin.bookings.update` | `update(Request $request, $id)` |
| DELETE | `/admin/bookings/{id}` | Delete booking | `admin.bookings.destroy` | `destroy($id)` |

### Reviews Management
| Method | Route | Action | Name | Controller Method |
|--------|-------|--------|------|------------------|
| GET | `/admin/reviews` | List all reviews | `admin.reviews.index` | `index()` |
| GET | `/admin/reviews/{id}` | Show review details | `admin.reviews.show` | `show($id)` |
| DELETE | `/admin/reviews/{id}` | Delete review | `admin.reviews.destroy` | `destroy($id)` |

### Admin Pages
| Route | Action | Name | Controller Method |
|-------|--------|------|------------------|
| GET `/admin/dashboard` | Admin dashboard | `admin.dashboard` | `PagesController@index()` |
| GET `/admin/reports` | Reports page | `admin.reports` | `PagesController@reports()` |
| GET `/admin/settings` | Settings page | `admin.settings` | `PagesController@settings()` |

---

## Owner/Vendor API (`/owner/*`)

### Business Profile
| Method | Route | Action | Name | Controller Method |
|--------|-------|--------|------|------------------|
| GET | `/owner/business-profile` | View profile | `owner.business.profile.show` | `show()` |
| GET | `/owner/business-profile/edit` | Show edit form | `owner.business.profile.edit` | `edit()` |
| PUT/PATCH | `/owner/business-profile` | Update profile | `owner.business.profile.update` | `update(Request $request)` |

### Services Management (Own Services Only)
| Method | Route | Action | Name | Controller Method |
|--------|-------|--------|------|------------------|
| GET | `/owner/services` | List vendor's services | `owner.services.index` | `index()` |
| GET | `/owner/services/create` | Show create form | `owner.services.create` | `create()` |
| POST | `/owner/services` | Store new service | `owner.services.store` | `store()` |
| GET | `/owner/services/{id}` | Show service details | `owner.services.show` | `show($id)` |
| GET | `/owner/services/{id}/edit` | Show edit form | `owner.services.edit` | `edit($id)` |
| PUT/PATCH | `/owner/services/{id}` | Update service | `owner.services.update` | `update(Request $request, $id)` |
| DELETE | `/owner/services/{id}` | Delete service | `owner.services.destroy` | `destroy($id)` |

### Payments (View Only)
| Method | Route | Action | Name | Controller Method |
|--------|-------|--------|------|------------------|
| GET | `/owner/payments` | List payments | `owner.payments.index` | `index()` |
| GET | `/owner/payments/{id}` | Show payment details | `owner.payments.show` | `show($id)` |

### Owner Pages
| Route | Action | Name | Controller Method |
|-------|--------|------|------------------|
| GET `/owner/dashboard` | Owner dashboard | `owner.dashboard` | `PagesController@index()` |
| GET `/owner/bookings` | Bookings list | `owner.bookings` | `PagesController@bookings()` |
| GET `/owner/properties` | Properties list | `owner.properties` | `PagesController@properties()` |
| GET `/owner/pricing-availability` | Pricing settings | `owner.pricing.availability` | `PagesController@pricingAvailability()` |
| GET `/owner/reviews` | Reviews list | `owner.reviews` | `PagesController@reviews()` |
| GET `/owner/analytics` | Analytics | `owner.analytics` | `PagesController@analytics()` |
| GET `/owner/notifications` | Notifications | `owner.notifications` | `PagesController@notifications()` |
| GET `/owner/reports` | Reports | `owner.reports` | `PagesController@reports()` |

---

## User/Customer API (`/user/*`)

### Profile Management
| Method | Route | Action | Name | Controller Method |
|--------|-------|--------|------|------------------|
| GET | `/user/profile` | View profile | `user.profile.show` | `show()` |
| GET | `/user/profile/edit` | Show edit form | `user.profile.edit` | `edit()` |
| PUT/PATCH | `/user/profile` | Update profile | `user.profile.update` | `update(Request $request)` |

### Orders Management
| Method | Route | Action | Name | Controller Method |
|--------|-------|--------|------|------------------|
| GET | `/user/orders` | List user's orders | `user.orders.index` | `index()` |
| GET | `/user/orders/create` | Show create form | `user.orders.create` | `create()` |
| POST | `/user/orders` | Create new order | `user.orders.store` | `store()` |
| GET | `/user/orders/{id}` | Show order details | `user.orders.show` | `show($id)` |

### Reviews Management
| Method | Route | Action | Name | Controller Method |
|--------|-------|--------|------|------------------|
| GET | `/user/reviews` | List user's reviews | `user.reviews.index` | `index()` |
| GET | `/user/reviews/create` | Show create form | `user.reviews.create` | `create()` |
| POST | `/user/reviews` | Create new review | `user.reviews.store` | `store()` |
| GET | `/user/reviews/{id}` | Show review details | `user.reviews.show` | `show($id)` |
| GET | `/user/reviews/{id}/edit` | Show edit form | `user.reviews.edit` | `edit($id)` |
| PUT/PATCH | `/user/reviews/{id}` | Update review | `user.reviews.update` | `update(Request $request, $id)` |
| DELETE | `/user/reviews/{id}` | Delete review | `user.reviews.destroy` | `destroy($id)` |

### User Pages
| Route | Action | Name | Controller Method |
|-------|--------|------|------------------|
| GET `/user/dashboard` | User dashboard | `user.dashboard` | `PagesController@index()` |
| GET `/user/wishlist` | Wishlist | `user.wishlist` | `PagesController@wishlist()` |
| GET `/user/notifications` | Notifications | `user.notifications` | `PagesController@notifications()` |
| GET `/user/support` | Support page | `user.support` | `PagesController@support()` |

---

## Form Field Specifications

### User Create/Edit Form
```
- name (text, required)
- email (email, required, unique)
- password (password, required on create, optional on edit)
- password_confirmation (password, required if password present)
- role (select: customer, vendor, admin, required)
- status (checkbox: active/inactive)
```

### Service Create/Edit Form
```
- name (text, required)
- description (textarea, required)
- category (select, required)
- price (decimal, required)
- status (select: active/inactive)
- vendor_id (hidden, auto-filled with auth vendor)
```

### Order Create Form
```
- service_id (select, required)
- quantity (number, required)
- booking_date (date, required)
- special_requests (textarea, optional)
```

### Review Create/Edit Form
```
- service_id (select, required)
- rating (radio: 1-5, required)
- comment (textarea, required, min 10 chars)
```

### Profile Edit Form
```
- name (text, required)
- email (email, required, unique except current)
- phone (text, optional)
- bio (textarea, optional)
- address (text, optional)
- city (text, optional)
- state (text, optional)
- zip_code (text, optional)
```

---

## Authorization Matrix

| Resource | Admin | Owner | User | Notes |
|----------|-------|-------|------|-------|
| Users | Full CRUD | - | - | Admin only |
| Owners/Vendors | Full CRUD | - | - | Admin only |
| Services (All) | Full CRUD | - | - | Admin can manage all |
| Services (Own) | - | Full CRUD | - | Vendor manages their own |
| Orders | Read/Update | - | Full CRUD | User creates/views own |
| Reviews (All) | Read/Delete | - | - | Admin can delete |
| Reviews (Own) | - | - | Full CRUD | User manages own |
| Business Profile | - | Read/Update | - | Vendor manages own |
| Payments | - | Read only | - | Vendor views own |
| Bookings | - | Read only | - | Vendor views own |

---

## Middleware & Protection

All authenticated routes are protected with:
1. `auth` middleware - User must be logged in
2. `role:role1,role2,...` middleware - User must have required role

Examples:
- `/admin/*` requires: `auth` + `role:admin,super_admin`
- `/owner/*` requires: `auth` + `role:vendor`
- `/user/*` requires: `auth` + `role:customer`

---

## Error Responses

All forms include error handling:
- **Field Errors:** Displayed inline with Bootstrap `is-invalid` class
- **Form Messages:** Toastr notifications for success/error
- **Flash Messages:** Session-based alerts for redirects

Example error display:
```blade
@error('email')
    <span class="invalid-feedback">{{ $message }}</span>
@enderror
```

---

## Navigation Routes

Use `route()` helper to generate URLs:

```blade
<!-- Admin Navigation -->
<a href="{{ route('admin.users.index') }}">Users</a>
<a href="{{ route('admin.owners.index') }}">Owners</a>
<a href="{{ route('admin.services.index') }}">Services</a>
<a href="{{ route('admin.bookings.index') }}">Bookings</a>
<a href="{{ route('admin.reviews.index') }}">Reviews</a>

<!-- Owner Navigation -->
<a href="{{ route('owner.services.index') }}">My Services</a>
<a href="{{ route('owner.business.profile.show') }}">Business Profile</a>
<a href="{{ route('owner.payments.index') }}">Payments</a>

<!-- User Navigation -->
<a href="{{ route('user.orders.index') }}">My Orders</a>
<a href="{{ route('user.profile.show') }}">My Profile</a>
<a href="{{ route('user.reviews.index') }}">My Reviews</a>
```

---

**Version:** 1.0  
**Last Updated:** Current Session  
**Status:** Complete and Ready ✅
