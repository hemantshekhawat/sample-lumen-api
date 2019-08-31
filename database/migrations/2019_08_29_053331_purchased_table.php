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
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';

                $table->bigInteger('user_id')->unsigned();
                $table->string('product_sku');
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
