<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteDetail extends Model
{
    protected $fillable = [
        'user_id', 'site_name', 'site_tagline', 'short_about','hero_banner_img',
    ];
}
