<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('patronymic')->nullable();
            $table->date('birth_day')->nullable();
            $table->boolean('gender')->nullable(true);
            $table->text('address');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->string('username');
            $table->string('password');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('supplier_id');
            $table->boolean('status')->default(false);
            $table->boolean('blocked')->default(false);
            $table->timestamps();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents');
    }
}
