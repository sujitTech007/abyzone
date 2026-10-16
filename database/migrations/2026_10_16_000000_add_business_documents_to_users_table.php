<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'business_documents')) {
            Schema::table('users', function (Blueprint $table) {
                $table->json('business_documents')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'business_documents')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('business_documents');
            });
        }
    }
};
