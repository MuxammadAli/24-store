<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsFromSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('on_credit');
            $table->dropColumn('permissions');
            $table->dropColumn('links');
            $table->dropColumn('buy_one');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('on_credit')->default(false);
            $table->jsonb('permissions')->default('{"middle_banner": true, "special_block":true,"lider_products":true,"popular_products":true,"new_products":true,"popular_categories":true,"brands":true}');
            $table->jsonb('links')->nullable();
            $table->boolean('buy_one')->default(true);
        });
    }
}
