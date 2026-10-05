<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('business_name')->nullable()->after('status');
            $table->string('business_type')->nullable()->after('business_name');
            $table->string('turnaround_time')->nullable()->after('business_type');
            $table->text('product_details')->nullable()->after('turnaround_time');
            $table->text('business_address')->nullable()->after('product_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'business_name',
                'business_type',
                'turnaround_time',
                'product_details',
                'business_address',
            ]);
        });
    }
};

