<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warehouse_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_booking_id')->unique()->constrained()->restrictOnDelete();
            $table->string('invoice_number', 40)->unique();
            $table->string('status', 30)->default('invoice_due');
            $table->char('currency', 3);
            $table->unsignedBigInteger('subtotal_cents');
            $table->decimal('tax_rate', 7, 4);
            $table->unsignedBigInteger('tax_cents');
            $table->unsignedBigInteger('total_cents');
            $table->json('invoice_snapshot');
            $table->string('stripe_checkout_session_id')->nullable()->unique();
            $table->string('stripe_payment_intent_id')->nullable()->index();
            $table->string('stripe_refund_id')->nullable()->index();
            $table->string('refund_status', 30)->nullable();
            $table->unsignedBigInteger('refunded_cents')->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamps();
        });

        Schema::create('warehouse_payment_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_payment_id')->constrained()->cascadeOnDelete();
            $table->string('event_type', 50);
            $table->string('status', 30)->nullable();
            $table->unsignedBigInteger('amount_cents')->nullable();
            $table->char('currency', 3)->nullable();
            $table->string('provider_reference')->nullable();
            $table->string('stripe_event_id')->nullable()->unique();
            $table->text('message')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('notification_sent_at')->nullable();
            $table->timestamps();
            $table->index(['warehouse_payment_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warehouse_payment_events');
        Schema::dropIfExists('warehouse_payments');
    }
};
