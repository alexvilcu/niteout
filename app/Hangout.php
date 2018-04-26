<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hangout extends Model
{
    public function users()
    {
    	return $this->hasMany('App\User');
    }

    public function owner()
    {
    	return $this->belongsTo('App\User');
    }
}
