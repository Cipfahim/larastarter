<?php

namespace Database\Seeders;

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
        // General Settings
        Setting::updateOrCreate(['name' => 'site_title','value' => 'LaraStarter']);
        Setting::updateOrCreate(['name' => 'site_description','value' => 'A laravel starter kit for web artisans.']);
        Setting::updateOrCreate(['name' => 'site_address','value' => 'Dhaka,Bangladesh']);
        // Logo Settings
        Setting::updateOrCreate(['name' => 'site_logo','value' => null]);
        Setting::updateOrCreate(['name' => 'site_favicon','value' => null]);
        // Mail Settings
        Setting::updateOrCreate(['name' => 'mail_mailer','value' => 'smtp']);
        Setting::updateOrCreate(['name' => 'mail_host','value' => 'smtp.mailtrap.io']);
        Setting::updateOrCreate(['name' => 'mail_port','value' => '2525']);
        Setting::updateOrCreate(['name' => 'mail_username','value' => '']);
        Setting::updateOrCreate(['name' => 'mail_password','value' => '']);
        Setting::updateOrCreate(['name' => 'mail_encryption','value' => 'TLS']);
        Setting::updateOrCreate(['name' => 'mail_from_address','value' => '']);
        Setting::updateOrCreate(['name' => 'mail_from_name','value' => 'LaraStarter']);

        // Socialite Settings
        Setting::updateOrCreate(['name' => 'facebook_client_id','value' => null]);
        Setting::updateOrCreate(['name' => 'facebook_client_secret','value' => null]);

        Setting::updateOrCreate(['name' => 'google_client_id','value' => null]);
        Setting::updateOrCreate(['name' => 'google_client_secret','value' => null]);

        Setting::updateOrCreate(['name' => 'github_client_id','value' => null]);
        Setting::updateOrCreate(['name' => 'github_client_secret','value' => null]);
    }
}
