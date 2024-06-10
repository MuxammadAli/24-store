<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
//            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('name')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->bigInteger('phone');
            $table->bigInteger('phone_other')->nullable();
            $table->string('address')->nullable();
            $table->string('apartment')->nullable();
            $table->string('floor')->nullable();
            $table->string('entrance')->nullable();
            $table->jsonb('location')->nullable();

            $table->softDeletes();
            $table->timestamps();

//            $table->foreign('city_id')->references('id')->on('cities');

        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
