<?php
use Illuminate\Database\Seeder;


class SettingTableSeeder extends Seeder {

    public function run()
    {
        DB::table('settings')->delete();

        \App\Setting::create(['key' => 'allowRegistration', 'value' => true]);
    }

}