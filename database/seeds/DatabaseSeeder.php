<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(TruncateSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(UserMenuSeeder::class);
         $this->call(RDKKSeeder::class);
         $this->call(UreaMt1Seeder::class);
         $this->call(UreaMt2Seeder::class);
         $this->call(NPKMt1Seeder::class);
         $this->call(NPKMt2Seeder::class);
         $this->call(SettingSeeder::class);
    }
}
