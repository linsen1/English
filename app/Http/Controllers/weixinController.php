<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2017/12/26
 * Time: 下午3:03
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\newWord;
use Illuminate\Support\Facades\DB;
use Curl\Curl;

class weixinController extends Controller
{
    private $appid='wxe9be027b8fafc3bc';
    private $secret='e7c10f9969efb27e02531542ea7e0b89';
    public function GetSessinID($js_code){
        $getSessionIDURL='https://api.weixin.qq.com/sns/jscode2session?appid='.$this->appid.'&secret='.$this->secret.'&js_code='.$js_code.'&grant_type=authorization_code';
        $curl=new Curl();
        $curl->get($getSessionIDURL);
        $result=$curl->response;
        return response($result);
    }
}