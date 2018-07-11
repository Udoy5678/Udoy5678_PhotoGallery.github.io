<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_img extends Model
{
    //
    protected $fillable = [
        'img_title', 'img_description', 'img_visibility','image','user_id',
    ];
}
