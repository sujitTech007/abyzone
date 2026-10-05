<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * We only add columns if they don't already exist to keep this safe when
     * the table has been modified manually or by previous migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouses', function (Blueprint $table) {
            if (! Schema::hasColumn('warehouses', 'images')) {
                $table->json('images')->nullable()->after('image');
            }
            if (! Schema::hasColumn('warehouses', 'available_from')) {
                $table->date('available_from')->nullable()->after('location');
            }
            if (! Schema::hasColumn('warehouses', 'warehouse_type')) {
                $table->string('warehouse_type')->nullable()->after('available_from');
            }
            if (! Schema::hasColumn('warehouses', 'warehouse_type_other')) {
                $table->string('warehouse_type_other')->nullable()->after('warehouse_type');
            }
            if (! Schema::hasColumn('warehouses', 'address_street')) {
                $table->string('address_street')->nullable()->after('location');
            }
            if (! Schema::hasColumn('warehouses', 'address_city')) {
                $table->string('address_city')->nullable();
            }
            if (! Schema::hasColumn('warehouses', 'address_state')) {
                $table->string('address_state')->nullable();
            }
            if (! Schema::hasColumn('warehouses', 'address_postal')) {
                $table->string('address_postal')->nullable();
            }
            if (! Schema::hasColumn('warehouses', 'capacity_quantity')) {
                $table->decimal('capacity_quantity', 12, 2)->nullable()->after('address_postal');
            }
            if (! Schema::hasColumn('warehouses', 'capacity_unit')) {
                $table->string('capacity_unit')->nullable()->after('capacity_quantity');
            }
            if (! Schema::hasColumn('warehouses', 'price_value')) {
                $table->decimal('price_value', 12, 2)->nullable()->after('capacity_unit');
            }
            if (! Schema::hasColumn('warehouses', 'price_unit')) {
                $table->string('price_unit')->nullable()->after('price_value');
            }
            if (! Schema::hasColumn('warehouses', 'infra_amenities')) {
                $table->json('infra_amenities')->nullable()->after('price_unit');
            }
            if (! Schema::hasColumn('warehouses', 'infra_amenities_others')) {
                $table->string('infra_amenities_others')->nullable()->after('infra_amenities');
            }
            if (! Schema::hasColumn('warehouses', 'service_template')) {
                $table->string('service_template')->nullable()->after('infra_amenities_others');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * Down method will drop columns if they exist.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouses', function (Blueprint $table) {
            foreach ([
                'service_template',
                'infra_amenities_others',
                'infra_amenities',
                'price_unit',
                'price_value',
                'capacity_unit',
                'capacity_quantity',
                'address_postal',
                'address_state',
                'address_city',
                'address_street',
                'warehouse_type_other',
                'warehouse_type',
                'available_from',
                'images',
            ] as $col) {
                if (Schema::hasColumn('warehouses', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};