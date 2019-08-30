<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class seedPurchased extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'purchased';
        $this->filename = base_path() . '/DATA/purchased.csv';
        $this->mapping = [
            0 => "user_id",
            1 => "product_sku"
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
