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
            $table->string('destination')->nullable()->default('ES_MAIN')->after('productKey');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_offers', function (Blueprint $table) {
            $table->dropColumn('destination');
        });
    }
};
