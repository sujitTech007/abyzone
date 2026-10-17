<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlansSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Starter',
                'description' => 'A sample plan for businesses getting started with warehouse services.',
                'price' => 49.00,
                'currency' => 'CAD',
                'billing_period' => 'monthly',
                'features' => [
                    'Warehouse discovery access',
                    'Basic booking request management',
                    'Email support',
                ],
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Growth',
                'description' => 'A sample plan for growing teams managing regular warehouse bookings.',
                'price' => 99.00,
                'currency' => 'CAD',
                'billing_period' => 'monthly',
                'features' => [
                    'Everything in Starter',
                    'Priority booking assistance',
                    'Booking history and reporting',
                    'Priority email support',
                ],
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Business',
                'description' => 'A sample plan for established businesses with broader logistics needs.',
                'price' => 199.00,
                'currency' => 'CAD',
                'billing_period' => 'monthly',
                'features' => [
                    'Everything in Growth',
                    'Dedicated account assistance',
                    'Multi-warehouse coordination',
                    'Custom onboarding consultation',
                ],
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::firstOrCreate(['name' => $plan['name']], $plan);
        }
    }
}
