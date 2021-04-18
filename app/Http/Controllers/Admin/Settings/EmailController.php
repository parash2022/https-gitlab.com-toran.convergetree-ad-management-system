<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\EmailSettingsRequest;
use App\Setting;
use App\Helpers\Settings as AppSettings;

class EmailController extends Controller
{
   
  public function index(){

  	 return view('administrator.settings.email');
  }

  public function store(EmailSettingsRequest $request){
    	
    	$data = $request->all();
    	unset($data['_token']);
    	if(is_array($data)){
    		foreach($data as $key=>$value){
    			$setting = Setting::firstOrCreate(['skey'=>$key]);
    			$setting->svalue = $value;
    			$setting->save();

    		}
    	}
      AppSettings::writeEmailConfig();

    	 return redirect()->route('administrator.settings.email.index')->with(['alert'=>['class'=>'success','msg'=>__('Email settings updated!')]]);
    }

}
