<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;

use App\Http\Requests\ClientRequest;


class ClientController extends Controller
{
    public function index(Request $request){
    	$clients = Client::paginate(10);
    	return view('administrator.clients.view',compact('clients'));
    }

    public function create(Request $request){
    	
    	return view('administrator.clients.create');
    }

    public function store(ClientRequest $request){ 

    	$client = new Client;
    	$client->name = $request->name;
    	$client->save();
    	return redirect()->route('administrator.clients.edit',[$client->id])->with(['alert'=>['class'=>'success','msg'=>__('New client added!')]]);
    }


    public function edit(Request $request){
    	$id = $request->id;
        $client = $request->id; 
    	$client = Client::find($id);
    	if(!$client) {return redirect()->route('administrator.clients.index');}
        
    	return view('administrator.clients.edit',compact('client'));
    }


    public function update(ClientRequest $request){
    	$id = $request->id;
    	$client = Client::find($id);
    	if(!$client) {return redirect()->route('administrator.clients.index');}
    	$client->name = $request->name;
    	$client->save();

    	return redirect()->route('administrator.clients.edit',[$client->id])->with(['alert'=>['class'=>'success','msg'=>__('Client updated!')]]);
    }


    public function delete(Request $request){
    	$id = $request->id;
    	$client = Client::find($id);
    	if($client){
    		$client->delete();
    	}
    	return redirect()->route('administrator.clients.index')->with(['alert'=>['class'=>'success','msg'=>__('Client deleted!')]]);
    }
}
