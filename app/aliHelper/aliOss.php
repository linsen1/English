<?php

/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/4/30
 * Time: 上午11:36
 */
namespace App\aliHelper;
use OSS\OssClient;
use OSS\Core\OssException;
class aliOss
{
    public  function  uploadByString($fileString,$path,$buckets){
        $accessKeyId = config('vcode.alifile.accessKeyId');
        $accessKeySecret =config('vcode.alifile.accessKeySecret');
        $endpoint =config('vcode.alifile.endpoint');
        $bucket= $buckets;
        $object =$path;
        $content=$fileString;
        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $ossClient->putObject($bucket, $object, $content);
            return true;
            //print("object content: " . $content);
        } catch (OssException $e) {
            return false;
            //print $e->getMessage();
        }
    }
}