<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_id')->constrained('users')->cascadeOnDelete();
            $table->string('requester_role', 20);
            $table->string('service_type', 120);
            $table->string('title', 180);
            $table->text('description');
            $table->string('service_location', 255);
            $table->date('needed_by')->nullable();
            $table->string('status', 20)->default('open');
            $table->timestamps();

            $table->index(['status', 'service_type']);
            $table->index(['requester_id', 'requester_role']);
        });

        Schema::create('service_requirement_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_requirement_id')->constrained('service_requirements')->cascadeOnDelete();
            $table->foreignId('channel_partner_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->text('description');
            $table->string('status', 20)->default('pending');
            $table->timestamps();

            $table->unique(
                ['service_requirement_id', 'channel_partner_id'],
                'service_req_partner_unique'
            );
            $table->index(['channel_partner_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requirement_offers');
        Schema::dropIfExists('service_requirements');
    }
};
