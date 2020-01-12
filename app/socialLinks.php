<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class socialLinks extends Model
{
    
	protected $fillable = [
        'user_id', 'title', 'fa_class','url', 
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
