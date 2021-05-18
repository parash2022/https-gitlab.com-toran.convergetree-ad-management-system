<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Carbon\Carbon;

class Term extends Model
{
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }

    public function runningAds()
    {
        $today = Carbon::today()->format('Y-m-d');
        return $this->belongsToMany(Ad::class)->whereDate('ads.publish_date', '<=', $today)->whereDate('ads.expiry', '>=', $today)->orderBy('updated_at', 'desc');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function parent()
    {
        return $this->hasMany(Term::class);
    }

    public function children()
    {
        return $this->hasMany(Term::class)->orderBy('name', 'asc');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}
