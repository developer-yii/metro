<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('custom_offers', function (Blueprint $table) {
            $table->integer('sync_interval')->default(3)->after('percentage'); // Default 3 hours
            $table->timestamp('last_synced_at')->nullable()->after('is_interested_product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_offers', function (Blueprint $table) {
            $table->dropColumn(['sync_interval', 'last_synced_at']);
        });
    }
};
