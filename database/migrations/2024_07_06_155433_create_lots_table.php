<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code');
            $table->integer('number');
            $table->uuid('agribusiness_id')->nullable();
            $table->uuid('batch_id');
            $table->foreign('batch_id')->references('id')->on('batchs')->onDelete('cascade');
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lots');
    }
};
