<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();

            $table->string('avatar')->nullable();
            $table->string('password')->nullable();

            $table->unsignedInteger('role_id')->default(2);

            $table->unsignedBigInteger('phone')->unique();
            $table->unsignedInteger('verify_code')->nullable();

            $table->boolean('gender')->default(true);
            $table->date('birth_day')->nullable();

//            $table->unsignedBigInteger('category_id')->nullable();
            $table->boolean('notification')->default(true);

            $table->string('language')->default('ru');

            $table->unsignedInteger('step')->default(1);
            $table->ipAddress('ip')->default('127.0.0.1');

            $table->string('email')->nullable();
            $table->string('postal_address')->nullable();

//            $table->timestamp('deleted_at')->nullable();
            $table->softDeletes();
            //$table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
