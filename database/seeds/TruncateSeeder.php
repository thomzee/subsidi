<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class TruncateSeeder extends Seeder
{
    private $exceptModels;

    public function __construct()
    {
        $this->exceptModels = [];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        foreach (scandir(app_path('Models')) as $file) {
            if (is_file(app_path('Models/' . $file))) {
                $fileModel = str_replace('.php', '', $file);
                if (!in_array($fileModel, $this->exceptModels)) {
                    $classModel = '\\App\Models\\' . $fileModel;
                    $tableName = (new $classModel)->table;
                    DB::table($tableName)->truncate();
                }
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
