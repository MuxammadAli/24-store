<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreensTable extends Migration
{
    public function up()
    {
        Schema::create('screens', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('path');
            $table->string('path_thumb')->nullable();
            $table->integer('product_id');
            $table->bigInteger('size')->default(0);
            $table->string('type')->default('image/jpeg');
            $table->integer('position')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('screens');
    }
}
