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
        Schema::create('offers', function (Blueprint $table) {
            $table->uuid('id')->primary();
          
            $table->string('selling_price')->nullable();
            $table->string('qte')->nullable();
            $table->string('weight')->nullable();
            $table->string('type_packaging')->nullable();
            
            $table->uuid('agribusiness_id');
            $table->uuid('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('agribusiness_id')->references('id')->on('agribusinesses');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
