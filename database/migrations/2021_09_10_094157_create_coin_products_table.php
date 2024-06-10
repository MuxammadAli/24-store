<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->jsonb('name')->nullable();
            $table->jsonb('body')->nullable();
            $table->jsonb('short_body')->nullable();
            $table->integer('price')->default(0);
            $table->string('slug')->nullable();
            $table->boolean('published')->default(false);
            $table->integer('views')->default(0);
            $table->integer('count')->default(0);
            $table->boolean('available')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('coin_products');
    }
}
