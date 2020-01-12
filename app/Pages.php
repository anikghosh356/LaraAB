<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    
    protected $fillable = [
        'user_id', 'page_name', 'page_content', 'page_status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
