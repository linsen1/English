<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EUsers extends Model
{
    protected $fillable=['id','nickName','gender','language','city','province','country','avatarUrl','openId']; //
}
