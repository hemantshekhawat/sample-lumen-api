<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class seedProducts extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'products';
        $this->filename = base_path() . '/DATA/products.csv';
        $this->mapping = [
            0 => "sku",
            1 => "name",
        ];
        $this->offset_rows = 1;
        $this->should_trim = true;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recommended when importing larger CSVs
//        DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        DB::table($this->table)->truncate();

        parent::run();
    }
}
