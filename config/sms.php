<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/3/22
 * Time: 上午11:24
 */
return [
  'ali'=>[
      'accessKeyId'=>'LTAI0qxlXg58cR0n',
      'accessKeySecret'=>'jCNqil9LFk1uoovtfOBNU5SwE6nMVQ',
      'SignName'=>'每天读些英文',
      'TemplateCode'=>'SMS_128580008',
      'TemplateCode_30'=>'SMS_127164363',
      'domain'=>'dysmsapi.aliyuncs.com'
  ],
  'rule'=>[
      'onePhoneMaxSmsNoInOneDay'=>4,//同一个手机号一天最多下发10条短信
      'oneIPMaxPhoneNOInOneDay'=>20,//同一个IP，请求的手机数量最多10条
      'OneCodeMaxTime'=>30//验证码有效期30分钟，在重新生成
  ]
];