<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sms extends Model
{
    public $accessKeyId;//
    public $accessKeySecret;
    public $SignName;
    public $TemplateCode;
    public $TemplateParam;
    public $PhoneNumbers;
    public $code;
    public $OutId;
    public $TemplateCode_30;
}
