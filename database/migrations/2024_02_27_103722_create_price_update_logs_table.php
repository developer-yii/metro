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
        Schema::create('price_update_logs', function (Blueprint $table) {
            $table->id();
            $table->string('productName')->nullable();
            $table->string('mmid')->nullable();
            $table->double('new_price', 14,2)->nullable();
            $table->double('old_price', 14,2)->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_update_logs');
    }
};
