<?php

use App\Models\Setting;
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
        Setting::updateOrCreate(['name' => 'application_name','value' => 'LaraStarter']);
        Setting::updateOrCreate(['name' => 'system_email','value' => 'admin@mail.com']);
        Setting::updateOrCreate(['name' => 'logo','value' => null]);
        Setting::updateOrCreate(['name' => 'favicon','value' => null]);
    }
}
