<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\VendorProfile;
use App\VendorDocument;
use App\VendorContact;
use App\Term;
use Hash;
use Storage;
use Config;

use App\Http\Requests\VendorRequest;

class VendorController extends Controller
{
    public function register(Request $request){
    	$categories = Term::where('taxonomy_id',2)->orderBy('name','asc')->get();
    	return view("app.vendor.register",compact('categories'));
    }

    public function store(VendorRequest $request){
    	$user = $this->registerVendor($request); 
        $user->terms()->attach($request->category);
    	$this->storeVendorProfile($user, $request);
    	$this->storeVendorContact($user, $request); 
    	$this->storeVendorDocument($user, $request);

         dispatch(new \App\Jobs\SendVendorRegistrationNotificationJob($user));
         dispatch(new \App\Jobs\SendVendorRegistrationSuccessJob($user));

        return redirect()->route('home')->with(['alert'=>['class'=>'success','msg'=>__('Registration request recieved. We will contact you shortly')]]);

    }

    private function storeVendorProfile($user, $request){
        
    	$vp = new VendorProfile;
    	$vp->user_id    		   = $user->id;
    	$vp->name 				   = $request->company_name;
    	$vp->trading_name		   = $request->trading_name;
    	$vp->address 			   = $request->address;
    	$vp->date_of_registration  = $request->date_of_registration;
    	$vp->no_of_experience_years= $request->no_of_experience_years;
    	$vp->no_of_clients 		   = $request->no_of_clients;
    	$vp->registration_no 	   = $request->registration_no;
    	$vp->pan_or_vat_no 		   = $request->pan_or_vat_no;
    	$vp->last_year_turnover    = $request->last_year_turnover;
        $vp->points                = $this->calculatePoint($request);
    	$vp->save();
        return true;
    }

    private function storeVendorContact($user, $request){

    	$vc = new VendorContact;
    	$vc->user_id    = $user->id;
    	$vc->name       = $request->contact_person_name;
    	$vc->email      = $request->contact_person_email;
    	$vc->mobile     = $request->contact_person_mobile;
        $vc->office_email     = $request->office_email;
        $vc->office_phone      = $request->office_phone;
    	$vc->save();
        return true;
    }

    private function storeVendorDocument($user, $request){

            $path = 'uploads/documents/'.date('Y').'/'.date('m');
            Storage::makeDirectory($path);

            $crc_path = '';
            $prc_path = '';
            $tcc_path = '';

            $crc  = $request->file('company_registration_certificate'); 
            $prc  = $request->file('pan_or_vat_registration_certificate');
            $tcc  = $request->file('tax_clearance_certificate');
            
            if($crc){
                 $crc_path  = Storage::disk('public')->put($path,$crc);
            }

            if($crc){
                $prc_path  = Storage::disk('public')->put($path,$prc);
            }

            if($crc){
                $tcc_path  = Storage::disk('public')->put($path,$tcc);
            }
           

            $vd = new VendorDocument;
            $vd->user_id = $user->id;
            $vd->company_registration = $crc_path;
            $vd->pan_vat_registration = $prc_path;
            $vd->tax_clearance        = $tcc_path;
            $vd->save();
            return true;
    }

    private function registerVendor($request){

        $user = new User;
        $user->name = $request->company_name;
        $user->email = $request->office_email;
        $user->password = Hash::make(time());
		$user->save();
        
        $user->role()->attach([5]);
        return $user;
    }


    private function calculatePoint($request){

        $clientPoint = 0;
        $experiencePoint = 0;
        $turnoverPoint = 0;
        $fullPoint = 60;
        $vendorConfig = Config('vendor');
        $clients    = $request->no_of_clients;
        $experience = $request->no_of_experience_years;
        $turnover   = $request->last_year_turnover;

        if(isset($vendorConfig['clients'][$clients])){
            $clientPoint = $vendorConfig['clients'][$clients];
        }

        if(isset($vendorConfig['experience'][$experience])){
            $experiencePoint = $vendorConfig['experience'][$experience];
        }

        if(isset($vendorConfig['turnover'][$turnover])){
            $turnoverPoint = $vendorConfig['turnover'][$turnover];
        }

        $totalPoint = $clientPoint + $experiencePoint + $turnoverPoint; 
        return ceil(($totalPoint/$fullPoint)*100);
    }   
}
