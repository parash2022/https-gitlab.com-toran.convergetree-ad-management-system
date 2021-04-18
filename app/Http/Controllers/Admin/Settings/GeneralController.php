<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralSettingsRequest;
use App\Setting;
use Config;
use Auth;


class GeneralController extends Controller
{
    public function index(){   
    	$languages   = Config::get('enum.languages');
    	$timezones   = Config::get('enum.timezones');
    	$dateformats = Config::get('enum.dateformats');
    	$timeformats = Config::get('enum.timeformats');
    	return view('administrator.settings.general', compact('languages','timezones','dateformats','timeformats'));
    }


    public function store(GeneralSettingsRequest $request){
    	
    	$data = $request->all();
    	unset($data['_token']);
    	if(is_array($data)){
    		foreach($data as $key=>$value){
    			$setting = Setting::firstOrCreate(['skey'=>$key]);
    			$setting->svalue = $value;
    			$setting->save();

    		}
    	}

    	 return redirect()->route('administrator.settings.general.index')->with(['alert'=>['class'=>'success','msg'=>__('General settings updated!')]]);
    }
}
