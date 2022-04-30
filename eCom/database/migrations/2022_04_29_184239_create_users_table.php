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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone_no')->unique();
            $table->string('password');
            $table->string('ip_address')->nullable();
            /*     $table->string('street_address')->nullable();
                   $table->unsignedInteger('division_id')->nullable();
                   $table->unsignedInteger('district_id')->nullable();
                   $table->string('zipcode')->nullable();
                   $table->string('country')->nullable();
                   $table->string('avatar')->nullable();*/
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
};
