<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/3/22
 * Time: 下午2:54
 */
namespace App\commonHelper;
class vcodeHelper {
    public function getVcode(){
        $host = config('vcode.aliYiYun.host');
        $path = config('vcode.aliYiYun.path');
        $method = "GET";
        $appcode = config('vcode.aliYiYun.AppCode');
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "border=yes&border_color=105%2C179%2C90&border_thickness=1&image_height=50&image_width=200&noise_color=black&obscurificator_impl=com.google.code.kaptcha.impl.WaterRipple&textproducer_char_length=5&textproducer_char_space=2&textproducer_char_string=abcde2345678gfynmnpwx&textproducer_font_color=black&textproducer_font_names=Arial%2C+Courier&textproducer_font_size=40";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return curl_exec($curl);
    }
}