<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;
class SendVendorRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $user = $this->user;
        $company_registration  = '';
        $pan_vat_registration  = '';
        $tax_clearance         = '';

        if(isset($user->vendorDocument->company_registration)){
            if(Storage::disk('public')->exists($user->vendorDocument->company_registration)){
               $company_registration = Storage::disk('public')->path($user->vendorDocument->company_registration);
            }
        } 
        if(isset($user->vendorDocument->pan_vat_registration)){
            if(Storage::disk('public')->exists($user->vendorDocument->pan_vat_registration)){
               $pan_vat_registration = Storage::disk('public')->path($user->vendorDocument->pan_vat_registration);
            }
        }
        if(isset($user->vendorDocument->tax_clearance)){
            if(Storage::disk('public')->exists($user->vendorDocument->tax_clearance)){
               $tax_clearance = Storage::disk('public')->path($user->vendorDocument->tax_clearance);
            }
        }
               
        return $this->subject('Vendor Registration')->view('app.mails.vendor-registration-notification',compact('user'))
        ->attach($company_registration)
        ->attach($pan_vat_registration)
        ->attach($tax_clearance);
    }
}
