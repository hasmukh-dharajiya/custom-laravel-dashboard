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
            $table->id();
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("password")->nullable();
            $table->timestamp("last_login_at");
            $table->string("location")->nullable();
            $table->string("gender")->nullable();
            $table->string("confirmation_code")->nullable();
            $table->string("last_login_ip")->nullable();
            $table->tinyInteger("confirmed")->nullable();
            $table->tinyInteger("status")->nullable();
            $table->tinyInteger("active")->nullable();
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
        Schema::dropIfExists('password_users');
    }
}
