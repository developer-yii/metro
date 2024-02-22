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
        Schema::create('custom_offers', function (Blueprint $table) {
            $table->id();
            $table->string('productKey')->nullable();
            $table->double('percentage',10,2)->nullable();
            $table->boolean('is_interested_product')->default(true);
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_offers');
    }
};
