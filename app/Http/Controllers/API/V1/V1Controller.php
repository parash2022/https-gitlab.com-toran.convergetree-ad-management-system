<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Platform;
use App\Term;
use Carbon\Carbon;
use App\Ad;
use App\Helpers\Thumbnail;
use DB;

class V1Controller extends Controller
{
    
   
    //platforms
    public function platforms(){
    	$data = [];
    	$response = ['status'=>true,'data'=>$data];
    	$platforms = Platform::get();
    	if(!$platforms->isEmpty()){
    		$i=0;
    		foreach($platforms as $pf){
    			$data[$i]['ID']  = $pf->id;
    			$data[$i]['name'] = $pf->name;
    			$i++;
    		}
    	}
    	$response['data'] = $data; 
    	echo json_encode($response); exit;
    }


	// ad types
    public function adTypes(){
    	$data = [];
    	$response = ['status'=>true,'data'=>$data];
    	$adtypes = Term::where('taxonomy_id',3)->get();
    	if(!$adtypes->isEmpty()){
    		$i=0;
    		foreach($adtypes as $at){
    			$data[$i]['ID']  = $at->id;
    			$data[$i]['name'] = $at->name;
    			$i++;
    		}
    	}
    	$response['data'] = $data; 
    	echo json_encode($response); exit;
    }


    // ad types
    public function adCategories(){
    	$data = [];
    	$response = ['status'=>true,'data'=>$data];
    	$adcats = Term::where('taxonomy_id',2)->get();
    	if(!$adcats->isEmpty()){
    		$i=0;
    		foreach($adcats as $ac){
    			$data[$i]['ID']  = $ac->id;
                $data[$i]['key']  = $ac->queryKey;
    			$data[$i]['name'] = $ac->name;

    			if($ac->children->count()){
    				$j = 0;
    				foreach($ac->children as $child){
    					$data[$i]['children'][$j]['ID']   = $child->id;
                        $data[$i]['children'][$j]['key']       = $child->queryKey;
    					$data[$i]['children'][$j]['name'] = $child->name;
    					$j++;
    				}
    			}
    			$i++;
    		}
    	}
    	$response['data'] = $data;
    	echo json_encode($response); exit;
    }

    public function ads(Request $request){ 
    	$data = [];
    	$response = ['status'=>true,'data'=>$data];
    	//parameters status,platform,adType,adCategory
    	//status: Running, Expired, Scheduled
    	//$validStatus = ['Running','Expired','Scheduled'];
    	$status   = 'Running';
    	$platform = $this->validatePlatform('App');
    	$category = $this->validateCategory($request->category);

        if($category['check'] && !$category['valid']){
            return response()->json($response);
        } 
    	//$adType   = $request->adType;
    	//$adCategory = $request->adCategory;
    

    	 $today = Carbon::today()->format('Y-m-d');
    	 $query = Ad::where('ads.id','>','0');
    	 if($status){
            if($status == 'Running'){
                $query->where('publish_date','<=',$today)->where('expiry','>=',$today);
            }
            if($status == 'Scheduled'){
                $query->where('publish_date','>',$today);
            }
            if($status == 'Expired'){
                $query->where('expiry','<',$today);
            }
        }

        if($platform['check'] && $platform['valid']){
            $query->where('platform_id',$platform['value']);
        }

        if($category['check'] && $category['valid']){
            $query->whereHas('terms',function($q) use($category){
                $q->whereIn('ad_term.term_id',$category['value']);
            });
        }

        $ads = $query->orderBy('id','DESC')->get();
        //output
        if(!$ads->isEmpty()){
    		$i=0;
    		foreach($ads as $at){
    	
    			$data[$i]['title'] = $at->title;
    			$data[$i]['url']   = $at->url;
    			$data[$i]['image'] = Thumbnail::url($at->image);
    			$data[$i]['adType']= $at->adType->name;
    		    $data[$i]['category']    = $this->Categories($at);
    			$i++;
    		}
    	}
    	$response['data'] = $data; 
    	echo json_encode($response); exit;

    }

    private function Categories($ad){
    	$arr = [];
    	if(!empty($ad->categories)){
    		foreach($ad->categories as $cat){
    			$arr[$cat->queryKey] = $cat->name;
    		}
    	}
    	return $arr;
    }

    private function validatePlatform($name){

    	$return = ['valid'=>false,'check'=>$name,'value'=>false];
    	if($name){
    		$object = Platform::where('name',$name)->first();
    		if($object){
    			$return['valid'] = true;
    			$return['value'] = $object->id;
    		}
    	}
    	return $return;
    }

    public function validateCategory($name){
    	$return = ['valid'=>false,'check'=>$name,'value'=>false];
    	$arr = [];
    	$cat = Term::where('name',$name)->orWhere('queryKey',$name)->first();
    	if($cat){
    			$return['valid'] = true;
    			$arr[] = $cat->id;
    			if($cat->children->count()){
    				foreach($cat->children as $child){
    					$arr[] = $child->id;
    				}	}
    		
    	}
    	$return['value']=$arr;
    	return $return;
    }

}
