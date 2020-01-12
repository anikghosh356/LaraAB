<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'user_id', 'post_title', 'post_slug', 'post_content','tags','category_id','post_thumbnail',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

     public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->where('status', 'active');
    }

}
