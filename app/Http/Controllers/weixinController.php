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

class ErrorCode
{
    public static $OK = 0;
    public static $IllegalAesKey = -41001;
    public static $IllegalIv = -41002;
    public static $IllegalBuffer = -41003;
    public static $DecodeBase64Error = -41004;
}
class WXBizDataCrypt
{
    private $appid;
    private $sessionKey;

    /**
     * 构造函数
     * @param $sessionKey string 用户在小程序登录后获取的会话密钥
     * @param $appid string 小程序的appid
     */
    public function WXBizDataCrypt( $appid, $sessionKey)
    {
        $this->sessionKey = $sessionKey;
        $this->appid = $appid;
    }


    /**
     * 检验数据的真实性，并且获取解密后的明文.
     * @param $encryptedData string 加密的用户数据
     * @param $iv string 与用户数据一同返回的初始向量
     * @param $data string 解密后的原文
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function decryptData( $encryptedData, $iv, &$data )
    {
        if (strlen($this->sessionKey) != 24) {
            return ErrorCode::$IllegalAesKey;
        }
        $aesKey=base64_decode($this->sessionKey);


        if (strlen($iv) != 24) {
            return ErrorCode::$IllegalIv;
        }
        $aesIV=base64_decode($iv);

        $aesCipher=base64_decode($encryptedData);

        $result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

        $dataObj=json_decode( $result );
        if( $dataObj  == NULL )
        {
            return ErrorCode::$IllegalBuffer;
        }
        if( $dataObj->watermark->appid != $this->appid )
        {
            return ErrorCode::$IllegalBuffer;
        }
        $data = $result;
        return ErrorCode::$OK;
    }

}
class weixinController extends Controller
{
    private $appids='wxe9be027b8fafc3bc';
    private $secret='e7c10f9969efb27e02531542ea7e0b89';

    public function GetSessinID($js_code){
        $getSessionIDURL='https://api.weixin.qq.com/sns/jscode2session?appid='.$this->appids.'&secret='.$this->secret.'&js_code='.$js_code.'&grant_type=authorization_code';
        $curl=new Curl();
        $curl->get($getSessionIDURL);
        $result=$curl->response;
        return response($result);
    }

    public function GetUserInfo(Request $request){
        $appid = 'wxe9be027b8fafc3bc';
        $sessionKey = 'o5KY/cbGNaF+H4v+7gOQhw==';
        $encryptedData="tpdw+ca+i7BSKiCKCWeADVxOaO/TyfEczID88HEkMyHvW7q0W4Z61JUDTFXd6Z2IIcd4HwEJQVjaGBz3fV9JYxEmFv/Q7xNRSv/eGNOhrnpX5bDHdgDNTubf0MGPusqDj7772w8CF0/1QrJ2mdXttcViN5E1WwFnp8Jc+zJT15sdzsPZjF+2Ra62BkIdQuOW74Nszyybg499t6X8XRdvezq2aJveos/CVR5tRLmpHoV8DiOxV2Jw8QP7iwmRNCyU5qSbhdqL2WTpdbeF8wE/P/uvuAeF8kBgujG0eYl9NiDaTk0d0DTKRA+J+q9K9oKE4D9ZEc5mN1ZVZNsztCj4R7Fx9TE+J+2AS5qeXMX55UVuii72KxpZOWaMGvn2Rr4RizPKLirIQirJpXKDaVbiAkG52u7QO/nM0FShY4UaAgBRRodo82RQPTRanAqRhzSzv27MFPWoR/hIls5J2Ids5yTMhGfSwyE8PQEM5ZjR/eM=";
        $iv = 'L7BTCyS70QHDn41N19VE4A==';
        $pc=new WXBizDataCrypt($appid,$sessionKey);
        $errCode = $pc->decryptData($encryptedData, $iv, $data );
        if ($errCode == 0) {
            var_dump($pc);

        } else {
            var_dump($pc);
        }
    }
}