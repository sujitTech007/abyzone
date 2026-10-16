<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('warehouse_bookings', 'requested_capacity_unit')) {
            Schema::table('warehouse_bookings', function (Blueprint $table) {
                $table->string('requested_capacity_unit')->nullable()->after('requested_capacity');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('warehouse_bookings', 'requested_capacity_unit')) {
            Schema::table('warehouse_bookings', function (Blueprint $table) {
                $table->dropColumn('requested_capacity_unit');
            });
        }
    }
};
