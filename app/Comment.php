<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = ['comment', 'user_id', 'location_id'];

    public function location()
    {
    	return $this->belongsTo('App\Location');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
