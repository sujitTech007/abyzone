<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verification_document_types', function (Blueprint $table) {
            $table->id();
            $table->string('role', 30);
            $table->string('name', 120);
            $table->string('description', 500)->nullable();
            $table->boolean('is_required')->default(true);
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['role', 'name'], 'verify_type_role_name_unique');
            $table->index(['role', 'is_active', 'sort_order'], 'verify_type_role_active_idx');
        });

        Schema::create('verification_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('document_type_id')->constrained('verification_document_types')->restrictOnDelete();
            $table->string('path', 500);
            $table->string('original_name', 255);
            $table->string('mime_type', 100);
            $table->unsignedBigInteger('size');
            $table->string('status', 20)->default('pending');
            $table->text('admin_note')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'document_type_id'], 'verify_doc_user_type_unique');
            $table->index(['status', 'created_at'], 'verify_doc_status_created_idx');
        });

        Schema::create('customer_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('target_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('warehouse_booking_id')->nullable()->constrained('warehouse_bookings')->cascadeOnDelete();
            $table->foreignId('service_requirement_id')->nullable()->constrained('service_requirements')->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->text('comment');
            $table->string('status', 20)->default('pending');
            $table->text('moderation_note')->nullable();
            $table->unsignedBigInteger('moderated_by')->nullable();
            $table->timestamp('moderated_at')->nullable();
            $table->timestamps();

            $table->unique(['author_id', 'warehouse_booking_id'], 'customer_review_booking_unique');
            $table->unique(['author_id', 'service_requirement_id'], 'customer_review_service_unique');
            $table->index(['target_user_id', 'status', 'created_at'], 'customer_review_target_status_idx');
        });

        $now = now();
        DB::table('verification_document_types')->insert([
            ['role' => 'customer', 'name' => 'Government-issued identity document', 'description' => 'Upload a clear, valid government-issued photo ID.', 'is_required' => true, 'is_active' => true, 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'vendor', 'name' => 'Government-issued identity document', 'description' => 'Upload a clear, valid government-issued photo ID for the business owner.', 'is_required' => true, 'is_active' => true, 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'vendor', 'name' => 'Business registration or license', 'description' => 'Upload current business registration or operating license documents.', 'is_required' => true, 'is_active' => true, 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'channel_partner', 'name' => 'Government-issued identity document', 'description' => 'Upload a clear, valid government-issued photo ID.', 'is_required' => true, 'is_active' => true, 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['role' => 'channel_partner', 'name' => 'Service license or certification', 'description' => 'Upload a current license or certification relevant to your services.', 'is_required' => true, 'is_active' => true, 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_reviews');
        Schema::dropIfExists('verification_documents');
        Schema::dropIfExists('verification_document_types');
    }
};
