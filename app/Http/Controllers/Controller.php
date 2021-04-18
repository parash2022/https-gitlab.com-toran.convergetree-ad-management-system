<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $settings;
    protected $theme;
    public function __construct(){

    	$this->settings = \Config::get('settings');
    	$theme = $this->getTheme();
    	$this->theme = "themes/$theme";
    }

    private function getTheme(){
    	if(isset($this->settings['site__active_theme']))
    		return $this->settings['site__active_theme'];
    	return 'themes.default';
    }
}
