<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mottos extends Model
{
    protected $fillable = ['englishWord', 'chineseWord', 'pic', 'xiaobian','audio'];//
}
