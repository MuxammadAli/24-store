<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_product_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coin_product_id');
            $table->integer('count')->default(0);
            $table->string('status')->default('new'); // new, viewed, processing, completed, cancelled
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('coin_product_id')->references('id')->on('coin_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_product_orders');
    }
}
