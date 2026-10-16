<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['users', 'warehouses'] as $tableName) {
            if (! Schema::hasColumn($tableName, 'address_country')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->string('address_country')->nullable();
                });
            }
        }

        foreach ([
            'address_street',
            'address_city',
            'address_state',
            'address_country',
            'address_postal',
        ] as $column) {
            if (! Schema::hasColumn('vendors', $column)) {
                Schema::table('vendors', function (Blueprint $table) use ($column) {
                    $table->string($column)->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        foreach (['users', 'warehouses', 'vendors'] as $tableName) {
            if (Schema::hasColumn($tableName, 'address_country')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('address_country');
                });
            }
        }

        foreach (['address_street', 'address_city', 'address_state', 'address_postal'] as $column) {
            if (Schema::hasColumn('vendors', $column)) {
                Schema::table('vendors', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
