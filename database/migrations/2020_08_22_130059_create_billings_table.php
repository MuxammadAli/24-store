<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->enum('status', ['payed', 'waiting', 'refused'])->default('waiting');
            $table->float('amount')->default(0);
            $table->string('payment_system')->nullable();
            $table->string('transaction_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billings');
    }
}
