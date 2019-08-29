<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PurchasedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable("purchased")) {
            Schema::create('purchased', function (Blueprint $table) {
                $table->integer('user_id',0,true);
                $table->string('product_sku');

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

                $table->foreign('product_sku')
                    ->references('sku')
                    ->on('products');
            });

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('purchased');
        Schema::enableForeignKeyConstraints();
    }
}
