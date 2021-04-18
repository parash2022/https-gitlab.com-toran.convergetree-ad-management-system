<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Term;
use DB;

class CategoryController extends Controller
{
    public function getSubCats(Request $request){
       
    	$categories = Term::where('taxonomy_id',2)->where('term_id',$request->catid)->orderBy('name','asc')->get();
    	$response = [];
    	if(!$categories->isEmpty()){
    		foreach($categories as $cat){
    			$response[$cat->id] = $cat->name;
    		}
    	}
       
    	echo json_encode($response);
    }
}
