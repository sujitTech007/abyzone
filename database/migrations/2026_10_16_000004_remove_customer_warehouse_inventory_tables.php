<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('warehouse_inventory_events');
        Schema::dropIfExists('warehouse_inventory_items');
    }

    public function down(): void
    {
        Schema::create('warehouse_inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_booking_id')->constrained()->cascadeOnDelete();
            $table->string('item_name', 150);
            $table->string('sku', 100)->nullable();
            $table->decimal('quantity', 12, 2)->default(0);
            $table->string('unit', 40);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['warehouse_booking_id', 'item_name']);
        });

        Schema::create('warehouse_inventory_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_booking_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('warehouse_inventory_item_id')->nullable()->constrained('warehouse_inventory_items')->nullOnDelete();
            $table->foreignId('actor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('item_name', 150);
            $table->string('action', 20);
            $table->decimal('from_quantity', 12, 2)->nullable();
            $table->decimal('to_quantity', 12, 2)->nullable();
            $table->string('unit', 40);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['warehouse_booking_id', 'created_at']);
        });
    }
};
