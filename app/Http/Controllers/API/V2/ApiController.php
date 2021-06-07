<?php

namespace App\Http\Controllers\API\V2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Platform;
use App\Taxonomy;
use App\Term;
use Carbon\Carbon;
use App\Ad;
use App\AppUser;
use App\Helpers\Thumbnail;
use DB;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

	//platforms
	public function platforms()
	{
		$data = [];
		$response = ['status' => true, 'data' => $data];
		$platforms = Platform::get();
		if (!$platforms->isEmpty()) {
			$i = 0;
			foreach ($platforms as $pf) {
				$data[$i]['ID']  = $pf->id;
				$data[$i]['name'] = $pf->name;
				$i++;
			}
		}
		$response['data'] = $data;
		echo json_encode($response);
		exit;
	}


	// ad types
	public function adTypes()
	{
		$data = [];
		$response = ['status' => true, 'data' => $data];
		$adtypes = Term::where('taxonomy_id', 3)->get();
		if (!$adtypes->isEmpty()) {
			$i = 0;
			foreach ($adtypes as $at) {
				$data[$i]['ID']  = $at->id;
				$data[$i]['name'] = $at->name;
				$i++;
			}
		}
		$response['data'] = $data;
		echo json_encode($response);
		exit;
	}


	// ad types
	public function adCategories()
	{
		$data = [];
		$response = ['status' => true, 'data' => $data];
		$adcats = Term::where('taxonomy_id', 2)->whereNull('term_id')->get();
		if (!$adcats->isEmpty()) {
			$i = 0;
			foreach ($adcats as $ac) {
				$data[$i]['ID']  = $ac->id;
				$data[$i]['key']  = $ac->queryKey;
				$data[$i]['name'] = $ac->name;

				if ($ac->children->count()) {
					$j = 0;
					foreach ($ac->children as $child) {
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
		echo json_encode($response);
		exit;
	}

	public function ads(Request $request)
	{

		$data 		= [];
		$noData		= [];
		$response 	= ['status' => true, 'data' => $data];

		//parameters status,platform,adType,adCategory
		//status: Running, Expired, Scheduled
		//$validStatus = ['Running','Expired','Scheduled'];
		$status   = 'Running';

		$isValidPlatform 	= $this->validatePlatform($request->platform);
		$isValid 			= $this->validateCategory($request->category);

		if ($isValid['check'] == '') {

			$isValid = $this->allCategory();
		}

		if ($isValid['check'] && !$isValid['valid']) {
			return response()->json($response);
		}
		if ($isValidPlatform['check'] && !$isValidPlatform['valid']) {
			return response()->json($response);
		}

		$categories = $isValid['value'];

		if ($categories) {
			foreach ($categories as $category) {

				$catName = ($isValid['check'] != '') ? $isValid['check'] : $category->queryKey;

				if (isset($category->id)) {

					if ($category->children->count() > 0) {
						foreach ($category->children as $child) {
							if ($isValidPlatform['valid']) {
								$ads = $child->runningAds->where('platform_id', $isValidPlatform['value']);
							} else {
								$ads = $child->runningAds;
							}

							if (!$ads->isEmpty()) {
								$i = 0;
								foreach ($ads as $at) {
									$data[$catName][$child->queryKey][$i]['platform'] 	= isset($at->platform->name) ? $at->platform->name : '';
									$data[$catName][$child->queryKey][$i]['adType']		= isset($at->adType->name) ? $at->adType->name : '';
									$data[$catName][$child->queryKey][$i]['title'] 		= $at->title;
									$data[$catName][$child->queryKey][$i]['url']   		= $at->url;
									$data[$catName][$child->queryKey][$i]['image'] 		= Thumbnail::url($at->image);
									$data[$catName][$child->queryKey][$i]['category']  	= $this->Categories($at);
									$i++;
								}
							} else {
								$noData[$catName][$child->queryKey] = [];
							}
						}
					} else {
						if ($isValidPlatform['valid']) {
							$ads = $category->runningAds->where('platform_id', $isValidPlatform['value']);
						} else {
							$ads = $category->runningAds;
						}
						if (!$ads->isEmpty()) {
							$i = 0;
							foreach ($ads as $at) {
								$data[$catName][$i]['platform'] = isset($at->platform->name) ? $at->platform->name : '';
								$data[$catName][$i]['adType']	= isset($at->adType->name) ? $at->adType->name : '';
								$data[$catName][$i]['title'] 	= $at->title;
								$data[$catName][$i]['url']   	= $at->url;
								$data[$catName][$i]['image'] 	= Thumbnail::url($at->image);
								$data[$catName][$i]['category'] = $this->Categories($at);
								$i++;
							}
						} else {
							$noData[$catName] = [];
						}
					}
				}
			}

			$response['data'] = array_merge_recursive($data, $noData);
			return response()->json($response);
		}
	}

	private function Categories($ad)
	{
		$arr = [];
		if (!empty($ad->categories)) {
			foreach ($ad->categories as $cat) {
				$arr[$cat->queryKey] = $cat->name;
			}
		}
		return $arr;
	}

	private function validatePlatform($name)
	{

		$return = ['valid' => false, 'check' => $name, 'value' => false];
		if ($name) {
			$object = Platform::where('name', $name)->first();
			if ($object) {
				$return['valid'] = true;
				$return['value'] = $object->id;
			}
		}
		return $return;
	}

	public function validateCategory($name)
	{

		$return = ['valid' => false, 'check' => $name, 'value' => false];
		$arr 	= [];

		if ($name != '') {

			$cat = Term::where('name', $name)->orWhere('queryKey', $name)->get();
			if ($cat) {

				$return['valid'] = true;
				$return['value'] = $cat;
			}
		}

		return $return;
	}

	public function allCategory()
	{

		$return = ['valid' => false, 'check' => '', 'value' => false];

		$slug 		= 'ad-category';
		$taxonomy 	= Taxonomy::where('slug', $slug)->first();
		if ($taxonomy) {

			$pcat = Term::where('term_id', NULL)->where('taxonomy_id', $taxonomy->id)->get();
			if ($pcat) {

				$return['valid'] = true;
				$return['value'] = $pcat;
			}
		}

		return $return;
	}

	public function appUser(Request $request)
	{
		$rules = [
			'token' 	=> 'required',
		];

		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$status = 'Added';
		//DB::enableQueryLog();
		$checkDeviceID 	= AppUser::where('deviceID', $request->token)->orderBy('id', 'desc')->first();
		//dd(DB::getQueryLog());		

		$userStat 		= true;

		if ($checkDeviceID) {

			$appUser 	=   $checkDeviceID;
			$status 	= $appUser->status;

			$userStat 	= ($status == 0) ? true : false;
		}

		$appUser = new AppUser;

		$appUser->deviceID 		= $request->token;
		$appUser->email 		= $request->email;
		$appUser->appVersion 	= $request->appVersion;
		$appUser->platform 		= $request->platform;
		$appUser->model 		= $request->model;
		$appUser->status 		= 1;
		if ($userStat == true)
			$appUser->save();

		$message = ($userStat == true) ? 'App User Added. ' : 'User Already exist. ';

		$response = ['status' => 'success', 'message' =>  $message];

		return response()->json($response, 200);
	}
}
