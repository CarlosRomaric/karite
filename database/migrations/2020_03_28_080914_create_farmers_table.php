<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('fullname');
            $table->string('picture')->nullable();
            $table->string('phone')->unique();
            $table->string('phone_payment')->unique();
            $table->dateTime('born_date')->nullable();
            $table->string('born_place', 100)->nullable();
            $table->uuid('region_id')->nullable();
            $table->uuid('departement_id')->nullable();
            $table->string('locality')->nullable();
            $table->string('activity')->nullable();
            $table->string('sexe', 10)->nullable();
            $table->uuid('agribusiness_id')->nullable();
            $table->uuid('user_id')->nullable();
           
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
        Schema::dropIfExists('farmers');
    }
}
