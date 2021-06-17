<?php


use Flynsarmy\CsvSeeder\CsvSeeder;

class RDKKSeeder extends CsvSeeder {

    public function __construct()
    {
        $this->table = 'petani';
        $this->filename = base_path().'/database/seeds/csv/rdkk.csv';
    }

    public function run()
    {
        // Recommended when importing larger CSVs
        \Illuminate\Support\Facades\DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        \Illuminate\Support\Facades\DB::table($this->table)->truncate();

        parent::run();
    }
}
