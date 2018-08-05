<?php

/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/6/18
 * Time: 下午9:08
 */
namespace App\commonHelper;
use Qcloud\Cos\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
include 'BaiduBce.phar';
use BaiduBce\BceClientConfigOptions;
use BaiduBce\Util\Time;
use BaiduBce\Util\MimeTypes;
use BaiduBce\Http\HttpHeaders;
use BaiduBce\Services\Bos\BosClient;
use OSS\OssClient;
use OSS\Core\OssException;

class fileHelper
{
    //上传至腾讯云
    public  function upTxCos($fileinfo,$filename,$fileFolder){
        $resultinfo=array();
        $cosClient=new  Client(array('region'=>config('appkey.txFrontend.COS_REGION'),
            'credentials'=> array(
                'appId' =>config('appkey.txFrontend.COS_APPID'),
                'secretId'    => config('appkey.txFrontend.COS_KEY'),
                'secretKey' =>config('appkey.txFrontend.COS_SecretKey'))));
        try {
            $result = $cosClient->putObject(array(
                'Bucket' =>config('appkey.txFrontend.COS_Bucket'),
                'Key' =>$fileFolder.'/'.$filename,
                'Body' =>fopen($fileinfo,'rb')));
            $resultinfo=array(
                "code"=>1,
                "msg"=>'上传成功');
            return  $resultinfo;
        } catch (\Exception $e) {
            $resultinfo=array(
                "code"=>0,
                "msg"=>$e);
            return $resultinfo;
        }
    }
    //上传文件
    public function upfile($file){
        $wenjian=$file;
        if ($wenjian->isValid()) {
            //获取文件的原文件名 包括扩展名
            $yuanname= $wenjian->getClientOriginalName();

            //获取文件的扩展名
            $kuoname=$wenjian->getClientOriginalExtension();

            //获取文件的类型
            $type=$wenjian->getClientMimeType();

            //获取文件的绝对路径，但是获取到的在本地不能打开
            $path=$wenjian->getRealPath();

            //要保存的文件名 时间+扩展名
            $filename=date('Y-m-d-H-i-s') . '_' . uniqid() .'.'.$kuoname;
            //保存文件          配置文件存放文件的名字  ，文件名，路径
            $bool= Storage::disk('upload')->put($filename,file_get_contents($path));
           // $this->upTxCos(Storage::disk('upload')->get($filename),$filename);
            return $filename;
        }else
        {
            return response("0");
        }
    }

    public  function upBaiduCos($fileinfo,$filename,$fileFolder)
    {
        $BOS_TEST_CONFIG =
            array(
            'credentials' => array(
                'accessKeyId' => config('appkey.baiduCos.AccessKey'),
                'secretAccessKey' =>config('appkey.baiduCos.SecretKey')
            ),
            'endpoint' => 'http://bj.bcebos.com',
        );
        $upfile=new BosClient($BOS_TEST_CONFIG);
        $buckName=config('appkey.baiduCos.bucketName');
        $fileKey=$fileFolder.'/'.$filename;
        $upfile->putObjectFromFile($buckName,$fileKey,$fileinfo);
    }

    //fileinfo 本地文件路径  filename  key 文件名  filefolder 文件夹名
    public  function  upAliCos($fileinfo,$filename,$fileFolder){

        $accessKeyId = config('appkey.aliCos.AccessKeyID');
        $accessKeySecret = config('appkey.aliCos.AccessKeySecret');
        $endpoint = config('appkey.aliCos.endpoint');
//您拥有的Bucket的名称。
        $bucket=config('appkey.aliCos.bucketName');
        $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
        $fileKey=$fileFolder.'/'.$filename;
//您要创建的Object的名称。
        try{
            $ossClient->uploadFile($bucket, $fileKey,$fileinfo);
            return response('success');
        } catch(OssException $e) {
            return $e;
        }
    }
}