<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Taxonomy extends Model
{
    
     use HasSlug;

      public function getSlugOptions() : SlugOptions{
        return SlugOptions::create()
                            ->generateSlugsFrom('name')
                            ->saveSlugsTo('slug');
    }

    public function terms(){
    	return $this->hasMany(Term::class);
    }

    public function parentTerms(){
    	return $this->hasMany(Term::class)->where('term_id',NULL);
    }
}
