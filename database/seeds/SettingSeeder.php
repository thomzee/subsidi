<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
            'key' => \App\Models\Setting::KEY_TAHUN,
            'value' => 2021,
        ]);

        \App\Models\Setting::create([
            'key' => \App\Models\Setting::KEY_MT,
            'value' => 2,
        ]);
    }
}
