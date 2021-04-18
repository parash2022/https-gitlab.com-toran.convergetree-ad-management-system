<?php
namespace App\Helpers;

use App\Setting;
use App\Taxonomy;
use DB;


Class Settings{

	public static function get($key=null){
		
		if(!$key){return false;}
	 	
	 	$row = Setting::where('skey',$key)->first();
	 	if(isset($row->svalue)){
	 		return $row->svalue;
	 	}
	 	return false;
	}

	public static function activePostTaxonomies(){
		$ids = null;
		$taxonomies = null;
		$setting = self::get('site__post_taxonomies');
		if($setting){
			$ids = json_decode($setting);
		}
		if(!empty($ids) && is_array($ids)){
			foreach($ids as $taxonomyId){
				$taxonomy = Taxonomy::find($taxonomyId);
				if($taxonomy){
					$taxonomies[] = Taxonomy::find($taxonomyId);
				}
				
			}
		}
		return $taxonomies;
	} //activePostTaxonomies

	public static function activeVendorTaxonomies(){
		$ids = null;
		$taxonomies = null;
		$setting = self::get('site__vendor_taxonomies'); 
		if($setting){
			$ids = json_decode($setting);
		}
		if(!empty($ids) && is_array($ids)){
			foreach($ids as $taxonomyId){
				$taxonomy = Taxonomy::find($taxonomyId);
				if($taxonomy){
					$taxonomies[] = Taxonomy::find($taxonomyId);
				}
				
			}
		}
		return $taxonomies;
	} //activePostTaxonomies


	public static function writeConfig(){
		$settings = Setting::all();
		$data = [];
		foreach($settings as $setting){
			$data[$setting->skey] = $setting->svalue;
		}
		$data = var_export( $data, true );
	    \File::put(base_path() . '/config/settings.php', "<?php\n return $data ;");
	}

	public static function writeEmailConfig(){
		$settings = [

					    /*
					    |--------------------------------------------------------------------------
					    | Mail Driver
					    |--------------------------------------------------------------------------
					    |
					    | Laravel supports both SMTP and PHP's "mail" function as drivers for the
					    | sending of e-mail. You may specify which one you're using throughout
					    | your application here. By default, Laravel is setup for SMTP mail.
					    |
					    | Supported: "smtp", "sendmail", "mailgun", "mandrill", "ses",
					    |            "sparkpost", "postmark", "log", "array"
					    |
					    */

					    'driver' => \App\Helpers\Settings::get('site__mail_driver'),

					    /*
					    |--------------------------------------------------------------------------
					    | SMTP Host Address
					    |--------------------------------------------------------------------------
					    |
					    | Here you may provide the host address of the SMTP server used by your
					    | applications. A default option is provided that is compatible with
					    | the Mailgun mail service which will provide reliable deliveries.
					    |
					    */

					    'host' => \App\Helpers\Settings::get('site__mail_host'),

					    /*
					    |--------------------------------------------------------------------------
					    | SMTP Host Port
					    |--------------------------------------------------------------------------
					    |
					    | This is the SMTP port used by your application to deliver e-mails to
					    | users of the application. Like the host we have set this value to
					    | stay compatible with the Mailgun e-mail application by default.
					    |
					    */

					    'port' => \App\Helpers\Settings::get('site__mail_port'),

					    /*
					    |--------------------------------------------------------------------------
					    | Global "From" Address
					    |--------------------------------------------------------------------------
					    |
					    | You may wish for all e-mails sent by your application to be sent from
					    | the same address. Here, you may specify a name and address that is
					    | used globally for all e-mails that are sent by your application.
					    |
					    */

					    'from' => [
					        'address' => \App\Helpers\Settings::get('site__mail_from'),
					        'name' => \App\Helpers\Settings::get('site__mail_from_name'),
					    ],

					    /*
					    |--------------------------------------------------------------------------
					    | E-Mail Encryption Protocol
					    |--------------------------------------------------------------------------
					    |
					    | Here you may specify the encryption protocol that should be used when
					    | the application send e-mail messages. A sensible default using the
					    | transport layer security protocol should provide great security.
					    |
					    */

					    'encryption' => \App\Helpers\Settings::get('site__mail_ecryption'),

					    /*
					    |--------------------------------------------------------------------------
					    | SMTP Server Username
					    |--------------------------------------------------------------------------
					    |
					    | If your SMTP server requires a username for authentication, you should
					    | set it here. This will get used to authenticate with your server on
					    | connection. You may also set the "password" value below this one.
					    |
					    */

					    'username' => \App\Helpers\Settings::get('site__mail_username'),

					    'password' => \App\Helpers\Settings::get('site__mail_password'),

					    /*
					    |--------------------------------------------------------------------------
					    | Sendmail System Path
					    |--------------------------------------------------------------------------
					    |
					    | When using the "sendmail" driver to send e-mails, we will need to know
					    | the path to where Sendmail lives on this server. A default path has
					    | been provided here, which will work well on most of your systems.
					    |
					    */

					    'sendmail' => '/usr/sbin/sendmail -bs',

					    /*
					    |--------------------------------------------------------------------------
					    | Markdown Mail Settings
					    |--------------------------------------------------------------------------
					    |
					    | If you are using Markdown based email rendering, you may configure your
					    | theme and component paths here, allowing you to customize the design
					    | of the emails. Or, you may simply stick with the Laravel defaults!
					    |
					    */

					    'markdown' => [
					        'theme' => 'default',

					        'paths' => [
					            resource_path('views/vendor/mail'),
					        ],
					    ],

					    /*
					    |--------------------------------------------------------------------------
					    | Log Channel
					    |--------------------------------------------------------------------------
					    |
					    | If you are using the "log" driver, you may specify the logging channel
					    | if you prefer to keep mail messages separate from other log entries
					    | for simpler reading. Otherwise, the default channel will be used.
					    |
					    */

					    'log_channel' => env('MAIL_LOG_CHANNEL'),

					];

		
		$settings = var_export( $settings, true );
	    \File::put(base_path() . '/config/mail.php', "<?php\n return $settings ;");
	}

}