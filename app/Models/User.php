<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'phone_code',
        'status',
        'business_name',
        'business_type',
        'turnaround_time',
        'product_details',
        'business_address',
        'warehouse_types',
        'warehouse_types_others',
        'address_street',
        'address_city',
        'address_state',
        'address_country',
        'address_postal',
        'business_documents',
        'partner_service_type',
        'partner_service_area',
        'partner_service_types',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'warehouse_types' => 'array',
        'business_documents' => 'array',
        'partner_service_types' => 'array',
    ];
    public function warehouses()
    {
        return $this->hasMany(Warehouse::class, 'user_id');
    }

    public function warehouseBookings()
    {
        return $this->hasMany(WarehouseBooking::class, 'customer_id');
    }

    public function receivedWarehouseBookings()
    {
        return $this->hasMany(WarehouseBooking::class, 'owner_id');
    }

    public function verificationDocuments()
    {
        return $this->hasMany(VerificationDocument::class);
    }

    public function customerReviewsReceived()
    {
        return $this->hasMany(CustomerReview::class, 'target_user_id');
    }

    public function approvedCustomerReviews()
    {
        return $this->customerReviewsReceived()->where('status', 'approved');
    }

    public function isVerified(): bool
    {
        $requiredTypeIds = VerificationDocumentType::query()
            ->where('role', $this->role)
            ->where('is_active', true)
            ->where('is_required', true)
            ->pluck('id');

        return $requiredTypeIds->isNotEmpty()
            && $this->verificationDocuments()
                ->whereIn('document_type_id', $requiredTypeIds)
                ->where('status', 'approved')
                ->count() === $requiredTypeIds->count();
    }

    public function notifications()
    {
        $userType = ($this->role === 'vendor') ? 'owner' : 'user';
        return $this->hasMany(Notification::class, 'user_id')->where('user_type', $userType);
    }

    public function unreadNotifications()
    {
        return $this->notifications()->where('is_read', false);
    }
}
