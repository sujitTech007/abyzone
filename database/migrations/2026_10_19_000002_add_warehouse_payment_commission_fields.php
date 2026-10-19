<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('warehouse_payments', function (Blueprint $table) {
            $table->decimal('commission_percent', 5, 2)->default(30)->after('total_cents');
            $table->unsignedBigInteger('commission_cents')->nullable()->after('commission_percent');
            $table->unsignedBigInteger('owner_net_cents')->nullable()->after('commission_cents');
            $table->unsignedBigInteger('commission_set_by')->nullable()->after('owner_net_cents');
            $table->timestamp('commission_set_at')->nullable()->after('commission_set_by');
        });

        DB::table('warehouse_payments')
            ->whereIn('status', ['paid', 'refund_pending', 'refund_failed'])
            ->update([
                'commission_cents' => DB::raw('ROUND(subtotal_cents * 0.30)'),
                'owner_net_cents' => DB::raw('subtotal_cents - ROUND(subtotal_cents * 0.30)'),
            ]);
        DB::table('warehouse_payments')
            ->where('status', 'refunded')
            ->update(['commission_cents' => 0, 'owner_net_cents' => 0]);
    }

    public function down(): void
    {
        Schema::table('warehouse_payments', function (Blueprint $table) {
            $table->dropColumn([
                'commission_percent',
                'commission_cents',
                'owner_net_cents',
                'commission_set_by',
                'commission_set_at',
            ]);
        });
    }
};
