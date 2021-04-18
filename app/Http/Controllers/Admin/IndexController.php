<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Client;
use App\Ad;
use DB;

class IndexController extends Controller
{
    public function index(Request $request){

    	$today = Carbon::today()->format('Y-m-d');
        $defaultDate = Carbon::now();
    	$plus7Days = $defaultDate->addDays(7)->format('Y-m-d');
    	
        $summary = [
                'totalClients' => Client::count(),
                'totalAds'     => Ad::count(),
                'runningAds'   => Ad::where('publish_date','<=',$today)->where('expiry','>=',$today)->count(),
                'soonExpiry'   => Ad::where('expiry','<=',$plus7Days)->where('expiry','>=',$today)->where('publish_date','>=',$today)->count(),
                'expired'      => Ad::where('expiry','<',$today)->count(),
                'scheduled'    => Ad::where('publish_date','>',$today)->count(),
        ];

    	return view('administrator.index',compact('summary'));
    }
}
