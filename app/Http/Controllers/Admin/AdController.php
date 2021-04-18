<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Thumbnail;
use App\Ad;
use App\Term;
use App\Client;
use App\Platform;
use Carbon\Carbon;

use App\Http\Requests\AdRequest;

class AdController extends Controller
{
   public function index(Request $request){
        $categories = Term::where('taxonomy_id',2)->where('term_id',NULL)->orderBy('name','asc')->get();
        $clients = Client::orderBy('name','ASC')->get();
        $adtypes = Term::where('taxonomy_id',3)->where('term_id',NULL)->orderBy('name','asc')->get();
        $platforms = Platform::orderBy('id','asc')->get();

        //search params
        $client_id    = intval($request->client);
        $platform_id  = intval($request->platform);
        $category_id = intval($request->category);
        $status      = trim($request->status);

    	//date params
        $today = Carbon::today()->format('Y-m-d');
        $defaultDate = Carbon::now();
        $plus7Days = $defaultDate->addDays(7)->format('Y-m-d');

        //build query
        $query = Ad::where('ads.id','>','0');
       
        if($platform_id>0){
            $query->where('platform_id',$platform_id);
        }
        
        if($client_id>0){
            $query->where('client_id',$client_id);
        }

        if($category_id>0){
            $query->whereHas('terms',function($q) use($category_id){
                $q->where('ad_term.term_id',$category_id);
            });
        }

        if($status){
            if($status == 'running'){
                $query->where('publish_date','<=',$today)->where('expiry','>=',$today);
            }
            if($status == 'scheduled'){
                $query->where('publish_date','>',$today);
            }
            if($status == 'going-to-expire'){
                $query->where('expiry','<=',$plus7Days)->where('expiry','>=',$today)->where('publish_date','>=',$today);
            }
            if($status == 'expired'){
                $query->where('expiry','<',$today);
            }
        }
        $ads = $query->orderBy('id','DESC')->paginate(10);
    	return view('administrator.ads.view',compact('ads','categories','clients','adtypes','platforms'));
    }

    public function create(Request $request){
        $today = Carbon::now();
        
    	$categories = Term::where('taxonomy_id',2)->where('term_id',NULL)->orderBy('name','asc')->get();
        $clients = Client::orderBy('name','ASC')->get();
        $adtypes = Term::where('taxonomy_id',3)->where('term_id',NULL)->orderBy('name','asc')->get();
        $platforms = Platform::orderBy('id','asc')->get();
    	return view('administrator.ads.create',compact('categories','clients','adtypes','platforms','today'));
    }

    public function store(AdRequest $request){  echo '<pre>'; print_r($request->all()); exit;
       
    	$desktop_featured_path =  Thumbnail::handleUpload($request->desktop_featured_photo);
        $mobile_featured_path =  Thumbnail::handleUpload($request->mobile_featured_photo);
       
        // ad Entry
    	$ad = new Ad;
        $ad->client_id    = $this->getClientId($request);
        $ad->adtype_id    = $request->adtype;
        $ad->publish_date   = $request->publish_date;
        $ad->expiry         = $request->expiry;
    	$ad->save();

        $platforms = $request->platform;
       
        //desktop entry
        if(in_array('1',$platforms)){

            $ad_desktop        = new AdsDesktop;
            $ad_desktop->ad_id = $ad->id;
            $ad_desktop->title = $request->desktop_title;
            $ad_desktop->url   = $request->desktop_url;
            $ad_desktop->image = isset($desktop_featured_path[0])?$desktop_featured_path[0]:'';

        }

        //mobile entry
        if(in_array('2',$platforms)){
            
            $ad_mobile        = new AdsMobile;
            $ad_mobile->ad_id = $ad->id;

            if($request->skip_mobile){

            $ad_mobile->title = $request->desktop_title;
            $ad_mobile->url   = $request->desktop_url;
            $ad_mobile->image = isset($desktop_featured_path[0])?$desktop_featured_path[0]:'';

            }else{

            $ad_mobile->title = $request->mobile_title;
            $ad_mobile->url   = $request->mobile_url;
            $ad_mobile->image = isset($mobile_featured_path[0])?$mobile_featured_path[0]:'';

            }     

        }

    	$ad->terms()->attach($request->cat);

    	return redirect()->route('administrator.ads.edit',[$ad->id])->with(['alert'=>['class'=>'success','msg'=>__('New ad added!')]]);
    }


    public function edit(Request $request){
    	
    	$categories = Term::where('taxonomy_id',2)->where('term_id',NULL)->orderBy('name','asc')->get();
        $clients = Client::orderBy('name','ASC')->get();
        $adtypes = Term::where('taxonomy_id',3)->where('term_id',NULL)->orderBy('name','asc')->get();
         $platforms = Platform::orderBy('id','asc')->get();
        $id = $request->id; 
    	$ad = Ad::find($id);
    	if(!$ad) {return redirect()->route('administrator.ads.index');}
        
    	return view('administrator.ads.edit',compact('ad','categories','clients','adtypes','platforms'));
    }


    public function update(AdRequest $request){

    	$featured_path =  Thumbnail::handleUpload($request->featured_photo);
         if(empty(array_filter($featured_path))){
            $featured_path[0] = $request->old_featured_photo;
        }

       

    	$ad = Ad::find($request->id);
        $ad->platform_id = $request->platform;
    	$ad->client_id = $request->client;
        $ad->adtype_id    = $request->adtype;
        $ad->title = $request->title;
        $ad->url   = $request->url;
        $ad->image = isset($featured_path[0])?$featured_path[0]:'';
        $ad->publish_date  = $request->publish_date;
        $ad->expiry  = $request->expiry;
    	$ad->save();

    	$ad->terms()->sync($request->cat);
    	return redirect()->route('administrator.ads.edit',[$ad->id])->with(['alert'=>['class'=>'success','msg'=>__('Ad updated!')]]);
    }


    public function delete(Request $request){
    	$id = $request->id;
    	$ad = Ad::find($id);
    	if($ad){
    		$ad->terms()->detach();
    		$ad->delete();
    	}
    	return redirect()->route('administrator.ads.index')->with(['alert'=>['class'=>'success','msg'=>__('Ad deleted!')]]);
    }

    public function copy(Request $request){
        $id = $request->id; 
        $ad = Ad::find($id);
        if(!$ad) {return redirect()->route('administrator.ads.index');}

        $copy = new Ad;
        $copy->platform_id  = $ad->platform_id;
        $copy->client_id    = $ad->client_id;
        $copy->adtype_id    = $ad->adtype_id;
        $copy->title        = $ad->title . ' -  Copy';
        $copy->url          = $ad->url;
        $copy->image        = $ad->image;
        $copy->publish_date  = $ad->publish_date;
        $copy->expiry        = $ad->expiry;
        $copy->save();

        $cats = [];
        if(!empty($ad->terms)){
            foreach($ad->terms as $term){
                $cats[] = $term->id;
            }
        }
        $copy->terms()->attach($cats);
        return redirect()->route('administrator.ads.index')->with(['alert'=>['class'=>'success','msg'=>__('Ad Copied!')]]);
    }

    private function getClientId($request){

        $client_id = $request->client;
        if($client_id == '0'){
            $client = new Client;
            $client->name = $request->client_name;
            $client->save();
            $client_id = $client->id;
        }
        return $client_id;
    }

    
}
