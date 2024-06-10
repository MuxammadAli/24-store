<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacteristicsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristics_products', function (Blueprint $table) {
//            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('characteristic_id');
            $table->string('value');


            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('characteristic_id')->references('id')->on('characteristics');
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characteristics_products');
    }
}
