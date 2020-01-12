<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'user_id', 'category_name', 
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function posts(){
    	return $this->hasMany('App\Post');
	}


}
