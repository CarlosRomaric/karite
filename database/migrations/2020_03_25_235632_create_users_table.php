<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('fullname');
            $table->string('username')->unique();
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->uuid('agribusiness_id')->nullable();
            $table->foreign('agribusiness_id')->references('id')->on('agribusinesses');
            $table->string('password');
            $table->string('picture')->nullable();
            $table->string('job')->nullable();
            $table->string('code')->nullable();
            $table->string('status')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
