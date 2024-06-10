<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id');
            $table->jsonb('name');
            $table->enum('type', ['text', 'number', 'radio', 'checkbox', 'select']);
            $table->jsonb('options')->nullable();
            $table->boolean('filter')->default(false);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characteristics');
    }
}
