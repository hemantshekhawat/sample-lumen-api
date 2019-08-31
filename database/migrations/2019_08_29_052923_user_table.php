<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("users")) {
            Schema::create('users', function (Blueprint $table) {
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';

                $table->increments('id');
                $table->string('email')->unique();
                $table->string('name');
                $table->string('password');
                $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();

    }
}
