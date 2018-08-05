<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sms;
use App\aliHelper\SignatureHelper;
use App\commonHelper\vcodeHelper;
use Illuminate\Support\Facades\DB;

class smsController extends Controller
{
    //发送短信及验证码
  public function sendSms($phone,$code){
      $smsInfo=new sms();
      $smsInfo->PhoneNumbers=$phone;
      $smsInfo->accessKeyId=config('sms.ali.accessKeyId');
      $smsInfo->accessKeySecret=config('sms.ali.accessKeySecret');
      $smsInfo->SignName=config('sms.ali.SignName');
      $smsInfo->TemplateCode_30=config('sms.ali.TemplateCode_30');
      $smsInfo->TemplateParam=Array (
          "code" =>$code
      );
      $smsInfo->OutId=(string)time();
      if(!empty($smsInfo->TemplateParam) && is_array($smsInfo->TemplateParam)) {
          $smsInfo->TemplateParam = json_encode($smsInfo->TemplateParam, JSON_UNESCAPED_UNICODE);
      }
      $helper=new SignatureHelper();
      $params=array();
      $params["PhoneNumbers"] =$smsInfo->PhoneNumbers;

      // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
      $params["SignName"] = $smsInfo->SignName;

      // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
      $params["TemplateCode"] = $smsInfo->TemplateCode_30;

      // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
      $params['TemplateParam'] =$smsInfo->TemplateParam;

      // fixme 可选: 设置发送短信流水号
      $params['OutId'] =$smsInfo->OutId;

      // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
      $params['SmsUpExtendCode'] = "1234567";
      $content = $helper->request(
          $smsInfo->accessKeyId,
          $smsInfo->accessKeySecret,
          config('sms.ali.domain'),
          array_merge($params, array(
              "RegionId" => "cn-hangzhou",
              "Action" => "SendSms",
              "Version" => "2017-05-25",
          ))
      // fixme 选填: 启用https
      // ,true
      );
      ini_set("display_errors", "on"); // 显示错误提示，仅用于测试时排查问题
// error_reporting(E_ALL); // 显示所有错误提示，仅用于测试时排查问题
      set_time_limit(0); // 防止脚本超时，仅用于测试使用，生产环境请按实际情况设置
      header("Content-Type: text/plain; charset=utf-8"); // 输出为utf-8的文本格式，仅用于测试
      return response()->json($content);
  }
  //发送人机验证码
  public function sendVcode(){
      $voder=new  vcodeHelper();
      $coderInfo=$voder->getVcode();
      $content=json_decode(strpbrk($coderInfo,'{'),true);
      return response()->json($content['showapi_res_body']);
  }

  public function getCode($phone){
     $code=random_int(100, 999);
     //新手机重未申请验证码
     $result=DB::table('phone_codes')->where([
          ['phone','=',$phone]
      ])->count();
     //手机号验证码已过期，删除
      $result1=DB::table('phone_codes')->where([
          ['phone','=',$phone],
          ['softDel','=','1']
      ])->count();
      //手机号验证码已超过30分钟（结束时间）
      $result2=DB::table('phone_codes')->where([
          ['phone','=',$phone],
          ['softDel','=','0'],
          ['endtime','<','2018-10-17']
      ])->count();
      //手机号未超过结束时间，且未超过60秒
      $result3=DB::table('phone_codes')->where([
          ['phone','=',$phone],
          ['softDel','=','0'],
          ['endtime','>','2017-10-17'],
          ['updated_at','>','60S']
      ])->count();
      //手机号未超过30分结束时间，且超过60秒
      $result4=DB::table('phone_codes')->where([
          ['phone','=',$phone],
          ['softDel','=','0'],
          ['endtime','>','2017-10-17'],
          ['updated_at','<','60S']
      ])->count();
     $infoMsg='';
      if($result==0){
          //新手机号，没有申请过验证码
          $code=random_int(1000, 9999);
          DB::table('phone_codes')->insert([
              'phone'=> $phone,
              'code'=>$code,
              'updated_at'=>date("Y-m-d H:i：s",time())
          ]);
          $infoMsg=$result;
      }
      //手机号已删除
      elseif ($result1>0){
          $infoMsg=$result1;
      }
      //手机号验证码超过30分钟
      elseif ($result2>0){
          $infoMsg=$result2;
      }
      //手机号验证码未超过1分钟
      elseif($result3>0){
          $infoMsg=$result3;
      }
      //手机号验证码超过1分钟
      elseif($result4>0){
          $infoMsg=$result4;
      }
      $msg=array();
      $msg['statusCode']=$infoMsg;
      $msg['code']=$code;
     return response()->json($msg);
  }

  public  function sendCode(Request $request){
      $phone=$request->input('phone');
      $IP=$request->getClientIp();
      $result=array();
      $result['data']='';
      $result['erro']='';
      if($this->validatePhoneSmsNo($phone)&&$this->validatePhoneNOIP($IP)){
          $checkPhone=DB::table("phone_codes")->where([
              ['phone','=',$phone]
          ])->count();
          //判断短信发送记录表里是否有该手机号,如果有
          if($checkPhone>0){
              //判断验证码的有效期是否超过30分钟
              $checkTime=DB::table("phone_codes")->where([
                  ['phone','=',$phone],
                  ['endTime','>',date("Y-m-d H:i:s",time())]
              ])->count();
              //没有超过30分钟
              if($checkTime>0){
                  $result['data']='读取一条记录';
                  $code=$this->getPhoneCode($phone)->{'code'};
                  $this->InsertPhoneCodeLog($phone,$IP,$code);
                  $this->sendSms($phone,$code);
              }else{
                  $code=$this->getCodes();
                  $this->InsertPhoneCodeLog($phone,$IP,$code);
                  $this->sendSms($phone,$code);
                  $result['data']="新增加一条记录";
              }
          }
          //新手机号
          else
          {
              $code=$this->getCodes();
              $this->InsertPhoneCodeLog($phone,$IP,$code);
              $this->sendSms($phone,$code);
              $result['data']="新增加一条记录：";
          }
      }else{
          $result['erro']='手机号数量超限制或者短信数量超限制'.$this->validatePhoneNOIP1($IP);
      }
      return response()->json($result);
  }
  //插入发送日志
  public function  InsertPhoneCodeLog($phone,$IP,$code)
  {
      $info=DB::table("phone_codes")->insert([
          'phone'=>$phone,
          'UserIP'=>$IP,
          'code'=>$code,
          'updated_at'=>date("Y-m-d H:i:s",time()),
          'Created_at'=>date("Y-m-d H:i:s",time()),
          'endTime'=>date("Y-m-d H:i:s",strtotime("+30 minute"))
      ]);
      return $info;
  }
  //读取验证码
  public function  getPhoneCode($phone){
      $code=DB::table('phone_codes')->select('code')->where([
          ['phone','=',$phone]
      ])->orderBy('id','desc')->first();
      return $code;
  }
  //判断同一个手机号当天请求验证码不能超过10次
  public function validatePhoneSmsNo($phone){
      $result=DB::table("phone_codes")->where([
         ['phone','=',$phone],
         ['created_at','>',date("Y-m-d",time())]
      ])->count();
      if($result>config('sms.rule.onePhoneMaxSmsNoInOneDay')){
          return false;
      }else
      {
          return true;
      }
  }
  public function validatePhoneNOIP($IP){
      $result=DB::table("phone_codes")->where([
          ['UserIP','=',$IP],
          ['created_at','>',date("Y-m-d",time())]
      ])->groupBy('phone')->count();

      if($result>config('sms.rule.oneIPMaxPhoneNOInOneDay')){

         return false;
      }else{
          return true;
      }
  }

    public function validatePhoneNOIP1($IP){
        $result=DB::table("phone_codes")->where([
            ['UserIP','=',$IP],
            ['created_at','>',date("Y-m-d",time())]
        ])->groupBy('phone')->count();

        return $result;
    }
  public  function  getCodes(){
      return random_int(1000, 9999);
  }
}
