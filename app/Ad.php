<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
	protected $dates = ['publish_date','expiry'];
    
     public function terms(){

        return $this->belongsToMany(Term::class);
    }

    public function categories(){

        return $this->belongsToMany(Term::class)->where('taxonomy_id','2');
    }

    public function adtype(){

        return $this->belongsTo(Term::class)->where('taxonomy_id','3');
    }

    public function platform(){
    	return $this->belongsTo(Platform::class);
    }
}
