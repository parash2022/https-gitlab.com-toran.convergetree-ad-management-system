<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Taxonomy;

use App\Http\Requests\TaxonomyRequest;

class TaxonomyController extends Controller
{
    public function index(Request $request){
    	$taxonomies = Taxonomy::paginate(10);
    	return view('administrator.taxonomies.view',compact('taxonomies'));
    }

    public function create(Request $request){
    	$taxonomies = Taxonomy::get();
    	return view('administrator.taxonomies.create',compact('taxonomies'));
    }

    public function store(TaxonomyRequest $request){ 

    	$taxonomies = new Taxonomy;
    	$taxonomies->name = $request->name;
    	$taxonomies->save();
    	return redirect()->route('administrator.taxonomies.edit',[$taxonomies->id])->with(['alert'=>['class'=>'success','msg'=>__('New taxonomy added!')]]);
    }


    public function edit(Request $request){
    	
        $id = $request->id; 
    	$taxonomy = Taxonomy::find($id);
    	if(!$taxonomy) {return redirect()->route('administrator.taxonomies.index');}
    	return view('administrator.taxonomies.edit',compact('taxonomy'));
    }


    public function update(TaxonomyRequest $request){

    	$id = $request->id;
		$taxonomy = Taxonomy::find($id);
    	if(!$taxonomy) {return route('administrator.taxonomies.index');}
    	$taxonomy->name = $request->name;
    	$taxonomy->save();
    	return redirect()->route('administrator.taxonomies.edit',[$taxonomy->id])->with(['alert'=>['class'=>'success','msg'=>__('Taxonomy updated!')]]);
    }


    public function delete(Request $request){
    	$id = $request->id;
    	$taxonomy = Taxonomy::find($id);
    	if($taxonomy){

            if($taxonomy->id == 1 ){
                return redirect()->route('administrator.taxonomies.index')->with(['alert'=>['class'=>'danger','msg'=>__('Restricted to delete!')]]);
            }

            if($taxonomy->terms->count()){
            	return redirect()->route('administrator.taxonomies.index')->with(['alert'=>['class'=>'danger','msg'=>__('Taxonomy has one or more terms!')]]);
            }
            $taxonomy->delete();
    	}
    	return redirect()->route('administrator.taxonomies.index')->with(['alert'=>['class'=>'success','msg'=>__('Taxonomy deleted!')]]);
    }
}
