<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

use App\Http\Requests\SocialMediaLinkRequest;

class SocialmediaController extends Controller
{
    public function index(){
    	$smlinks = [];
    	$row = Setting::where(['skey'=>'site__social_media_links'])->first();
    	if(isset($row->svalue)){
    		$encodedlinks = $row->svalue;
    	} 
    	if(isset($encodedlinks)){
    		$smlinks = json_decode($encodedlinks);
    	} 
    	return view('administrator.settings.socialmedia',compact('smlinks'));
    }

    public function store(SocialMediaLinkRequest $request){

    	$links = $request->sm;
    	$links = array_values(array_unique(array_filter($links)));
    	$links = json_encode($links);

    	$setting = Setting::firstOrCreate(['skey'=>'site__social_media_links']);
    	$setting->svalue = $links;
    	$setting->save();
    	 return redirect()->route('administrator.settings.socialmedia.index')->with(['alert'=>['class'=>'success','msg'=>__('Social media links  updated!')]]);

    }
}
