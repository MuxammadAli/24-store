<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('address_id')->nullable();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();

            $table->float('price_product')->default(0);
            $table->float('price_delivery')->nullable();

//            $table->integer('price_product')->nullable();
            $table->float('discount')->nullable();

            $table->timestamp('shipment_date')->nullable();

            $table->enum('type_delivery', ['delivery', 'pickup'])->default('delivery');
            $table->jsonb('currency');
            $table->unsignedBigInteger('branch_id')->nullable();

            $table->enum('status', ['processing', 'collected', 'waiting_buyer', 'in_way', 'closed', 'cancelled', 'replacement'])->default('processing');

            $table->enum('payment_type', ['cash', 'payme', 'apelsin', 'click', 'uzcard', 'oson', 'credit', 'upay', 'paynet'])->default('cash');
            $table->enum('payment_status', ['waiting', 'cancelled', 'payed', 'cash', 'review'])->default('waiting');

            $table->text('comment')->nullable();

            $table->enum('type', ['default', 'one_click'])->default('default');
            $table->jsonb('apelsin_data')->nullable();
            $table->boolean('archived')->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
