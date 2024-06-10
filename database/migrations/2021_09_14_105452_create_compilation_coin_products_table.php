<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompilationCoinProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compilation_coin_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compilation_id');
            $table->unsignedBigInteger('coin_product_id');
            $table->integer('position')->default(0);
            $table->timestamps();
            $table->foreign('compilation_id')->references('id')->on('compilations')->cascadeOnDelete();
            $table->foreign('coin_product_id')->references('id')->on('coin_products')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compilation_coin_products');
    }
}
