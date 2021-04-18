<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\role;

use App\Http\Requests\RoleRequest;


class RoleController extends Controller
{
     public function index(Request $request){
    	$roles = Role::paginate(10);
    	return view('administrator.roles.view',compact('roles'));
    }

    public function create(Request $request){
    	$roles = Role::get();
    	return view('administrator.roles.create',compact('roles'));
    }

    public function store(RoleRequest $request){ 

    	$role = new Role;
    	$role->title = $request->title;
    	$role->save();
    	return redirect()->route('administrator.roles.edit',[$role->id])->with(['alert'=>['class'=>'success','msg'=>__('New role added!')]]);
    }


    public function edit(Request $request){
    	
        $id = $request->id; 
    	$role = Role::find($id);
    	if(!$role) {return redirect()->route('administrator.roles.index');}
        if($role->id == 1 || $role->id == 5){
            return redirect()->route('administrator.roles.index')->with(['alert'=>['class'=>'danger','msg'=>__('Restricted to edit!')]]);
        }
    	return view('administrator.roles.edit',compact('role'));
    }


    public function update(RoleRequest $request){

    	$id = $request->id;
		$role = Role::find($id);
    	if(!$role) {return route('administrator.roles.index');}
    	$role->title = $request->title;
    	$role->save();
    	return redirect()->route('administrator.roles.edit',[$role->id])->with(['alert'=>['class'=>'success','msg'=>__('Role updated!')]]);
    }


    public function delete(Request $request){
    	$id = $request->id;
    	$role = Role::find($id);
    	if($role){

            if($role->id == 1 && $role->title == 'Administrator'){
                return redirect()->route('administrator.roles.index')->with(['alert'=>['class'=>'danger','msg'=>__('Restricted to delete!')]]);
            }

    		if(isset($role->user)){
    			if($role->user->count()>0){
    				return redirect()->route('administrator.roles.index')->with(['alert'=>['class'=>'danger','msg'=>__('Role is assigned to one or more users!')]]);
    			}else{
    				$role->delete();
    			}
    		}
    	}
    	return redirect()->route('administrator.roles.index')->with(['alert'=>['class'=>'success','msg'=>__('Role deleted!')]]);
    }
}
