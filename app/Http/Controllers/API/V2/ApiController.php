<?php

namespace App\Http\Controllers\API\V2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Platform;
use App\Term;
use Carbon\Carbon;
use App\Ad;
use App\Helpers\Thumbnail;
use DB;

class ApiController extends Controller
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
    	$adcats = Term::where('taxonomy_id',2)->whereNull('term_id')->get();
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
    	$isValidPlatform = $this->validatePlatform($request->platform);
    	$isValid = $this->validateCategory($request->category);

        if($isValid['check'] && !$isValid['valid']){
            return response()->json($response);
        } 
        if($isValidPlatform['check'] && !$isValidPlatform['valid']){
            return response()->json($response);
        } 
    	
        $category = $isValid['value'];

    	if(isset($category->id)){

            
            if($category->children->count()>0){
                foreach($category->children as $child){
                    if($isValidPlatform['valid']){
                         $ads = $child->runningAds->where('platform_id',$isValidPlatform['value']);
                     }else{
                         $ads = $child->runningAds;
                     }
                   
                    if(!$ads->isEmpty()){
                    $i=0;
                    foreach($ads as $at){
                        $data[$isValid['check']][$child->queryKey][$i]['platform'] = isset($at->platform->name)?$at->platform->name:'';
                        $data[$isValid['check']][$child->queryKey][$i]['adType']= isset($at->adType->name)?$at->adType->name:'';
                        $data[$isValid['check']][$child->queryKey][$i]['title'] = $at->title;
                        $data[$isValid['check']][$child->queryKey][$i]['url']   = $at->url;
                        $data[$isValid['check']][$child->queryKey][$i]['image'] = Thumbnail::url($at->image);
                        $data[$isValid['check']][$child->queryKey][$i]['category']    = $this->Categories($at);
                        $i++;
                    }
                }
                }
            }else{
                if($isValidPlatform['valid']){
                     $ads = $category->runningAds->where('platform_id',$isValidPlatform['value']); 
                    }else{
                        $ads = $category->runningAds;
                     }
                if(!$ads->isEmpty()){
                    $i=0;
                    foreach($ads as $at){
                        $data[$isValid['check']][$i]['platform'] = isset($at->platform->name)?$at->platform->name:'';
                        $data[$isValid['check']][$i]['adType']= isset($at->adType->name)?$at->adType->name:'';
                        $data[$isValid['check']][$i]['title'] = $at->title;
                        $data[$isValid['check']][$i]['url']   = $at->url;
                        $data[$isValid['check']][$i]['image'] = Thumbnail::url($at->image); 
                        $data[$isValid['check']][$i]['category']    = $this->Categories($at);
                        $i++;
                    }
                }
            } 
            $response['data'] = $data;
            return response()->json($response);

            
        }


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
            $return['value'] = $cat;
    		
            
    	}
    	return $return;
    }

}
