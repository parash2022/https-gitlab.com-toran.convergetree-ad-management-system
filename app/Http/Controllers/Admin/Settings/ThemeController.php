<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Helpers\Settings as AppSettings;

class ThemeController extends Controller
{
    public function index(){  
    	$themes = $this->validateThemes($this->getThemeNames());
    	return view('administrator.settings.theme',compact('themes'));
    }

    public function store(Request $request){
    	$theme = $request->theme;
    	$setting = Setting::firstOrCreate(['skey'=>'site__active_theme']);
    	$setting->svalue = $theme;
    	$setting->save();
        AppSettings::writeConfig();
    	return redirect()->route('administrator.settings.theme.index')->with(['alert'=>['class'=>'success','msg'=>__('Theme Activated!')]]);
    }

    private function getThemeNames(){
    	$themeBasePath = base_path().'\resources\views\themes';
    	$themeNames = [];
    	$themePaths = glob($themeBasePath.'/*'  , GLOB_ONLYDIR);
    	if(is_array($themePaths)){
    		foreach($themePaths as $themePath){
    			$themeNames[] = basename($themePath);
    		}
    	}
    	return $themeNames;
    }

    private function validateThemes($themes){
    	$valid = [];
    	$assetBasePath = public_path().'/assets/themes/';
    	if(is_array($themes) && !empty($themes)){
    		foreach($themes as $i=>$theme){
    			$valid[$i]['name'] = $theme;
    			$valid[$i]['error'] = '';
    			$valid[$i]['warning'] = '';
    			if(str_slug($theme) == $theme){
    				if(!file_exists($assetBasePath.$theme)){
    					$valid[$i]['warning'] = __('No assets found');
    				}
    			}else{
    				$valid[$i]['error'] =  __('Invalid theme folder name');
    			}

    		}
    	}
    	return $valid;
    } //validate themes
}
