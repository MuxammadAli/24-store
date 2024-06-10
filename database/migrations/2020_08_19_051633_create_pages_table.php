<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->jsonb('name');
            $table->string('slug');
            $table->jsonb('body');
            $table->unsignedInteger('type')->nullable();

            $table->jsonb('descriptions')->default('{"ru":"","uz":""}');
            $table->jsonb('keywords')->default('{"ru":"","uz":""}');

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
        Schema::dropIfExists('pages');
    }
}
