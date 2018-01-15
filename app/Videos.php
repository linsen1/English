<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    protected $fillable =['id','video_title','video_poster','video_SDdataSize','video_HDdataSize','video_FHDdataSize','video_SDURL','video_HDURL','video_FHDURL','video_introduce',
        'video_dialog_bg','video_dialog_english','video_dialog_chinese','video_goldenSentence'];//
}
