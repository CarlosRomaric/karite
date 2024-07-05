<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgribusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agribusinesses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('matricule', 100);
            $table->string('denomination')->nullable();
            $table->string('sigle')->nullable();
            $table->string('address')->nullable();
            $table->uuid('region_id')->nullable();
            $table->uuid('departement_id')->nullable();
            $table->string('headquaters')->nullable();
            $table->string('bank')->nullable();
            $table->string('certification')->nullable();
            $table->string('registre_commerce')->nullable();
            $table->string('dfe')->nullable();
            $table->string('number_sections')->nullable();
            $table->string('number_unite_transformations')->nullable();
            $table->string('logo')->nullable();
            $table->string('status')->nullable();
            $table->string('motif')->nullable();
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
        Schema::dropIfExists('agribusinesses');
    }
}
