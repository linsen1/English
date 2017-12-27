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
    public $sessionKey;
    public $OK = 0;
    public $IllegalAesKey = -41001;
    public $IllegalIv = -41002;
    public $IllegalBuffer = -41003;
    public $DecodeBase64Error = -41004;

    /**
     * 检验数据的真实性，并且获取解密后的明文.
     * @param $encryptedData string 加密的用户数据
     * @param $iv string 与用户数据一同返回的初始向量
     * @param $data string 解密后的原文
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function decryptData($encryptedData, $iv, &$data )
    {
        if (strlen($this->sessionKey) != 24) {

            return $this->IllegalAesKey;
        }
        $aesKey=base64_decode($this->sessionKey);


        if (strlen($iv) != 24) {
            return $this->IllegalIv;
        }
        $aesIV=base64_decode($iv);

        $aesCipher=base64_decode($encryptedData);

        $result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

        $dataObj=json_decode( $result );
        if( $dataObj  == NULL )
        {
            return $this->IllegalBuffer;
        }
        if( $dataObj->watermark->appid != $this->appid )
        {
            return $this->IllegalBuffer;
        }
        $data = $result;
        return $this->OK;
    }

    public function GetSessinID($js_code){
        $getSessionIDURL='https://api.weixin.qq.com/sns/jscode2session?appid='.$this->appids.'&secret='.$this->secret.'&js_code='.$js_code.'&grant_type=authorization_code';
        $curl=new Curl();
        $curl->get($getSessionIDURL);
        $result=$curl->response;
        return response($result);
    }

    public function GetUserInfo(Request $request){
        $this->sessionKey =$request->input("sessionKey");
        $encryptedData=$request->input("encryptedData");
        $iv =$request->input("iv");
        $errCode =$this->decryptData($encryptedData, $iv, $data);
        if ($errCode == 0) {
            return response($data,201)->header('Content-Type', 'application/json');
        } else {
          var_dump($errCode);
        }
    }
}