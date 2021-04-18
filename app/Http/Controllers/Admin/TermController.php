<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Taxonomy;
use App\Term;

use App\Http\Requests\TermRequest;

class TermController extends Controller
{
        public function index(Request $request){
    	
    	$taxonomy = Taxonomy::where('slug',$request->taxonomy)->first();
    	if(!$taxonomy) {return route('administrator.terms.index');}
    	$terms = Term::where('term_id',NULL)->where('taxonomy_id',$taxonomy->id)->paginate(10);
    	return view('administrator.terms.view',compact('terms','taxonomy'));
    }

    public function create(Request $request){
    	
    	$taxonomy = Taxonomy::where('slug',$request->taxonomy)->first();
    	if(!$taxonomy) {return route('administrator.terms.index');}

    	$parent = Term::where('term_id',NULL)->where('taxonomy_id',$taxonomy->id)->get();
    	
    	return view('administrator.terms.create',compact('parent','taxonomy'));
    }

    public function store(TermRequest $request){ 
    	
    	$taxonomy = Taxonomy::where('slug',$request->taxonomy)->first();
    	if(!$taxonomy) {return route('administrator.terms.index');}

    	$term = new Term;
    	$term->taxonomy_id = $taxonomy->id;
    	$term->term_id = $request->parent;
        $term->queryKey = $this->categoryKey($request);
    	$term->name = $request->name;
    	$term->save();

    	return redirect()->route('administrator.terms.index',[$taxonomy->slug])->with(['alert'=>['class'=>'success','msg'=>__('New term added!')]]);
    }


    public function edit(Request $request){
    	
    	$taxonomy = Taxonomy::where('slug',$request->taxonomy)->first();
    	if(!$taxonomy) {return route('administrator.terms.index');}

        $id = $request->id; 
    	$term = Term::find($id);
    	if(!$term) {return redirect()->route('administrator.terms.index');}

    	$parent = Term::where('term_id',NULL)->where('taxonomy_id',$taxonomy->id)->get();

    	return view('administrator.terms.edit',compact('taxonomy','term','parent'));
    }


    public function update(TermRequest $request){

    	$taxonomy = Taxonomy::where('slug',$request->taxonomy)->first();
    	if(!$taxonomy) {return route('administrator.terms.index');}

    	$id = $request->id;
		$term = Term::find($id);
    	if(!$term) {return route('administrator.terms.index');}

    	$term->taxonomy_id = $taxonomy->id;
    	$term->term_id = $request->parent;
        $term->queryKey = $this->categoryKey($request);
    	$term->name = $request->name;
    	$term->save();
    	return redirect()->route('administrator.terms.index',[$taxonomy->slug])->with(['alert'=>['class'=>'success','msg'=>__('Term updated!')]]);
    }


    public function delete(Request $request){

    	$taxonomy = Taxonomy::where('slug',$request->taxonomy)->first();
    	if(!$taxonomy) {return route('administrator.terms.index');}

    	$id = $request->id;
    	$term = Term::find($id);
    	if($term){
    		Term::where('term_id',$term->id)->update(['term_id'=>NULL]); 
            $term->delete();
    	}
    	return redirect()->route('administrator.terms.index',[$taxonomy->slug])->with(['alert'=>['class'=>'success','msg'=>__('Term deleted!')]]);
    }

    private function categoryKey($request){
        
        $parentId = $request->parent;
        $catname  = $request->name;
        $parentname = '';
        $string = '';
        if($parentId && is_numeric($parentId)){
            $category = Term::find($parentId);
            if($category){
                $parentname = $category->name.' ';
            }
        }
        $string = $parentname.$catname;
        preg_match_all("/[A-Z]/", $string, $matches);
        return strtoupper(implode('',$matches[0]));
    }
}
