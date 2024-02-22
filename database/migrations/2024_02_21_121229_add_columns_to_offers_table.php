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
        Schema::table('offers', function (Blueprint $table) {
            $table->string('productName')->nullable()->after('offer_price');
            $table->string('mid')->nullable()->after('productName');
            $table->string('quantity')->nullable()->after('mid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('productName');
            $table->dropColumn('mid');
            $table->dropColumn('quantity');
        });
    }
};
