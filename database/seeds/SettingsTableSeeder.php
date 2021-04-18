<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $settings = [ 
                //general
                'site__url'        => url('/'),
                'site__path'       => base_path(),
                'site__title'      => 'Laraverge',
                'site__tagline'    => 'Do something better',
                'site__admin_email' => 'admin@laraverge.com',
                'site__language'   => 'en',
                'site__timezone'   => 'America/New_York',
                'site__date_format' => 'd M, Y',
                'site__time_format' => 'g:i A',

                //email
                'site__mail_from'      => 'donotreply@laraverge.com',
                'site__mail_from_name' => 'Laraverge',
                'site__mail_driver'    => 'sendmail',
                'site__mail_port'      => '',
                'site__mail_host'      => '',
                'site__mail_username'  => '',
                'site__mail_password'  => '',
                'site__mail_ecryption' => '0',

                //social media
                'site__social_media_links' => '["https:\/\/www.facebook.com\/","https:\/\/twitter.com\/"]',

                //taxonomy
                'site__page_taxonomies' => '[]',
                'site__post_taxonomies' => '["1"]',

                //theme
                'site__active_theme'    => 'default',
                ];

        foreach($settings as $skey=>$svalue){
            Setting::Create(['skey'=>$skey,'svalue'=>$svalue]);
        }

    }
}
