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
            $table->string('qte')->nullable();
            $table->string('certification')->nullable();
            $table->string('type_packaging')->nullable();
            $table->string('type_achat')->nullable();
            $table->string('amount')->nullable();
            $table->uuid('farmer_id');
            $table->uuid('agribusiness_id');
            $table->uuid('user_id');

            $table->foreign('farmer_id')->references('id')->on('farmers');
            $table->foreign('agribusiness_id')->references('id')->on('agribusinesses');
            $table->foreign('user_id')->references('id')->on('users');

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
