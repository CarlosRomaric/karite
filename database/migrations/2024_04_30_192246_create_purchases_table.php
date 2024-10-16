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
        Schema::create('purchases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('weight')->nullable();
            $table->string('quality')->nullable();
           
            $table->string('type_purchase')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('amount')->nullable();
            $table->uuid('farmer_id');
            $table->uuid('agribusiness_id')->nullable();
            $table->uuid('user_id');
            $table->uuid('sealed_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
