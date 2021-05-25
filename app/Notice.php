<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    /**
     * 
     * @var array
     */
    protected $fillable = ['title', 'body'];

    public function user()
    {

        return $this->belongsToMany(User::class);
    }
}
