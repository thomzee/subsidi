<?php


use Flynsarmy\CsvSeeder\CsvSeeder;

class UreaMt2Seeder extends CsvSeeder {

    public function __construct()
    {
        $this->table = 'petani_mt';
        $this->filename = base_path().'/database/seeds/csv/urea_mt_2.csv';
        $this->csv_delimiter = ';';
    }

    public function run()
    {
        // Recommended when importing larger CSVs
        \Illuminate\Support\Facades\DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
//        \Illuminate\Support\Facades\DB::table($this->table)->truncate();

        parent::run();
    }
}
