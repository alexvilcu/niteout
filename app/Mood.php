<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{	
	public function locations()
	{
		return $this->hasMany('App\Location');
	}
	protected $fillable = ['name'];
	
}
