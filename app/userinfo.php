<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userinfo extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'phone','address','verification_code',
    ];
   

}

