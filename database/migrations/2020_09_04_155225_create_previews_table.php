<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previews', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->jsonb('name')->nullable();
            $table->float('price', 18)->default(0);
            $table->float('price_discount', 18)->nullable();

            $table->string('brand')->nullable();
            $table->integer('category_id');

            $table->jsonb('characteristics')->nullable();

            $table->boolean('popular')->default(false);
            $table->boolean('leader_of_sales')->default(false);
            $table->string('article_number')->nullable();

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
        Schema::dropIfExists('previews');
    }
}
