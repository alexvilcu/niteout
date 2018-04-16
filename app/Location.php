<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	protected $fillable = ['name', 'address', 'photo', 'type', 'music', 'mood_id'];

    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }
    public function mood()
    {
    	return $this->belongsTo('App\Mood');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
