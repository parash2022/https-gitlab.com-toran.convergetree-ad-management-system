<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdministratorController extends Controller
{
    
    public function index(Request $request){
    	
    	return view('administrator.index');
    }
}
