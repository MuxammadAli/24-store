<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();

//            $table->string('name',144);
            $table->string('username', 144)->unique();
            $table->string('password');
            $table->unsignedBigInteger('role_id')->default(1);
            $table->boolean('block')->default(false);
            $table->rememberToken();

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
