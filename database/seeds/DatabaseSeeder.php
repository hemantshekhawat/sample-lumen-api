<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call('seedUsers');
         $this->call('seedProducts');
         $this->call('seedPurchased');
        Schema::enableForeignKeyConstraints();
    }
}
