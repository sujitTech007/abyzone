<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->allowCancelledStatus();

        if (! Schema::hasColumn('warehouse_bookings', 'cancellation_reason')) {
            Schema::table('warehouse_bookings', function (Blueprint $table) {
                $table->text('cancellation_reason')->nullable();
            });
        }

        if (! Schema::hasTable('warehouse_booking_events')) {
            Schema::create('warehouse_booking_events', function (Blueprint $table) {
                $table->id();
                $table->foreignId('warehouse_booking_id')->constrained()->cascadeOnDelete();
                $table->string('event_type', 40);
                $table->string('from_status', 40)->nullable();
                $table->string('to_status', 40);
                $table->foreignId('actor_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('actor_role', 20);
                $table->text('message')->nullable();
                $table->timestamps();
                $table->index(['warehouse_booking_id', 'created_at']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('warehouse_booking_events');

        if (Schema::hasColumn('warehouse_bookings', 'cancellation_reason')) {
            Schema::table('warehouse_bookings', function (Blueprint $table) {
                $table->dropColumn('cancellation_reason');
            });
        }

        $this->removeCancelledStatus();
    }

    private function allowCancelledStatus(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE warehouse_bookings MODIFY status ENUM('pending', 'approved', 'declined', 'meeting_scheduled', 'cancelled') NOT NULL DEFAULT 'pending'");

            return;
        }

        if ($driver === 'sqlite') {
            $this->rebuildSqliteBookingTable(true);

            return;
        }

        throw new RuntimeException("Adding booking cancellation is not implemented for the {$driver} database driver.");
    }

    private function removeCancelledStatus(): void
    {
        if (DB::table('warehouse_bookings')->where('status', 'cancelled')->exists()) {
            throw new RuntimeException('Cancelled bookings exist; preserve or resolve them before rolling back this migration.');
        }

        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE warehouse_bookings MODIFY status ENUM('pending', 'approved', 'declined', 'meeting_scheduled') NOT NULL DEFAULT 'pending'");

            return;
        }

        if ($driver === 'sqlite') {
            $this->rebuildSqliteBookingTable(false);

            return;
        }

        throw new RuntimeException("Removing booking cancellation is not implemented for the {$driver} database driver.");
    }

    private function rebuildSqliteBookingTable(bool $addCancelled): void
    {
        $schema = DB::selectOne("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = 'warehouse_bookings'");
        if (! $schema?->sql) {
            throw new RuntimeException('The warehouse_bookings table definition could not be found.');
        }

        $definition = preg_replace(
            '/^CREATE TABLE ["`\[]?warehouse_bookings["`\]]?/i',
            'CREATE TABLE "warehouse_bookings_rebuilt"',
            $schema->sql,
            1,
            $tableReplacements
        );
        if ($tableReplacements !== 1) {
            throw new RuntimeException('Unable to prepare the warehouse_bookings table definition.');
        }

        $definition = preg_replace_callback(
            '/("status"\s+in\s*\()([^)]+)(\))/i',
            function ($matches) use ($addCancelled) {
                $statuses = preg_replace("/,\s*'cancelled'/", '', $matches[2]);

                return $matches[1].$statuses.($addCancelled ? ", 'cancelled'" : '').$matches[3];
            },
            $definition,
            1,
            $statusReplacements
        );
        if ($statusReplacements !== 1) {
            throw new RuntimeException('Unable to update the warehouse booking status constraint.');
        }

        $columns = collect(DB::select("PRAGMA table_info('warehouse_bookings')"))
            ->pluck('name')
            ->map(fn ($column) => '"'.str_replace('"', '""', $column).'"')
            ->implode(', ');

        DB::statement($definition);
        DB::statement("INSERT INTO warehouse_bookings_rebuilt ({$columns}) SELECT {$columns} FROM warehouse_bookings");
        DB::statement('DROP TABLE warehouse_bookings');
        DB::statement('ALTER TABLE warehouse_bookings_rebuilt RENAME TO warehouse_bookings');
    }
};
