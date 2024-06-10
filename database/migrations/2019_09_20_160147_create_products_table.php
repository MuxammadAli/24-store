<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->jsonb('name')->nullable();
            $table->jsonb('body')->nullable();
            $table->jsonb('short_body')->nullable();

            $table->float('price', 18)->default(0);
            $table->float('price_discount', 18)->nullable();

            $table->string('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();

//            $table->string('poster')->nullable();
//            $table->string('poster_thumb')->nullable();
            $table->text('color_id')->nullable();

            $table->jsonb('sizes')->nullable();

            $table->jsonb('characteristics')->nullable();

            $table->string('slug')->nullable();
            $table->boolean('published')->default(false);
//            $table->unsignedBigInteger('child_id')->nullable();
//            $table->string('currency')->default('sum');

            $table->boolean('popular')->default(false);
            $table->boolean('leader_of_sales')->default(false);

            $table->string('article_number')->nullable();

            $table->integer('views')->default(0);
            $table->integer('count')->default(0);
            $table->boolean('available')->default(true);

            $table->jsonb('title_seo')->default('{"ru":"","uz":""}');
            $table->jsonb('descriptions')->default('{"ru":"","uz":""}');
            $table->jsonb('keywords')->default('{"ru":"","uz":""}');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands');
//            $table->foreign('child_id')->references('id')->on('products');
//            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
