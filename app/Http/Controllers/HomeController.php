<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Term;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $categories = Term::where('taxonomy_id',2)->where('term_id',NULL)->orderBy('name','asc')->get();
        $vendorConfig = Config('vendor'); 
        return view("app.home",compact('categories','vendorConfig'));
    }
}
