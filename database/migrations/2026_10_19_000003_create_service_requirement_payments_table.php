<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_requirements', function (Blueprint $table) {
            $table->timestamp('partner_completed_at')->nullable();
            $table->timestamp('requester_completed_at')->nullable();
            $table->timestamp('service_completed_at')->nullable();
        });

        Schema::create('service_requirement_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_requirement_id')->constrained(
                'service_requirements',
                'id',
                'sr_payment_requirement_fk'
            )->cascadeOnDelete();
            $table->foreignId('service_requirement_offer_id')->constrained(
                'service_requirement_offers',
                'id',
                'sr_payment_offer_fk'
            )->restrictOnDelete();
            $table->foreignId('requester_id')->constrained('users', 'id', 'sr_payment_requester_fk')->restrictOnDelete();
            $table->foreignId('channel_partner_id')->constrained('users', 'id', 'sr_payment_partner_fk')->restrictOnDelete();
            $table->string('status', 30)->default('payment_due');
            $table->char('currency', 3)->default('CAD');
            $table->unsignedBigInteger('amount_cents');
            $table->string('stripe_checkout_session_id')->nullable()->unique();
            $table->string('stripe_payment_intent_id')->nullable()->index();
            $table->string('stripe_event_id')->nullable()->unique();
            $table->timestamp('paid_at')->nullable();
            $table->decimal('commission_percent', 5, 2)->nullable();
            $table->unsignedBigInteger('commission_cents')->nullable();
            $table->unsignedBigInteger('partner_net_cents')->nullable();
            $table->unsignedBigInteger('commission_set_by')->nullable();
            $table->timestamp('commission_set_at')->nullable();
            $table->timestamps();

            $table->unique('service_requirement_id', 'sr_payment_requirement_unique');
            $table->unique('service_requirement_offer_id', 'sr_payment_offer_unique');
            $table->index(['status', 'paid_at'], 'service_payment_status_paid_idx');
            $table->index(['requester_id', 'created_at'], 'service_payment_requester_idx');
            $table->index(['channel_partner_id', 'created_at'], 'service_payment_partner_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requirement_payments');

        Schema::table('service_requirements', function (Blueprint $table) {
            $table->dropColumn([
                'partner_completed_at',
                'requester_completed_at',
                'service_completed_at',
            ]);
        });
    }
};
