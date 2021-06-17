<?php


namespace App\Services;


use App\Models\Setting;

class SettingService
{
    public static function currentTahun()
    {
        return Setting::where('key', Setting::KEY_TAHUN)->first()->value;
    }

    public static function currentMt()
    {
        return Setting::where('key', Setting::KEY_MT)->first()->value;
    }
}
