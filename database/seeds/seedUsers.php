<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class seedUsers extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'users';
        $this->filename = base_path() . '/DATA/users.csv';
        $this->mapping = [
            0 => "id",
            1 => "name",
            2 => "email",
            3 => "password"
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
