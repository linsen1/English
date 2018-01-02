<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MyMottosController extends Controller
{
   public function AddUserMotto(Request $request){
       date_default_timezone_set("Asia/Chongqing");
       $userMottos=array(
           'openId'=>$request->input('openId'),
           'mottos_id'=>$request->input('mottos_id')
       );
       if($this->checkUserMotto($userMottos)){
           $result=DB::table('my_mottos')->insert([
               'openId'=>$request->input('openId'),
               'mottos_id'=>$request->input('mottos_id'),
               'created_at'=>date("Y-m-d H:i",time()),
               'updated_at'=>date("Y-m-d H:i",time())
           ]);
           return response()->json($result);
       }else
       {
           $result=array(
             'result'=>0
           );
           return response()->json($result);
       }
   }
   public function checkUserMotto($mottos){
       $count=DB::table('my_mottos')->where([
           ['openId','=',$mottos['openId']],
           ['mottos_id','=',$mottos['mottos_id']],
       ])->count();
       if($count>0){
           return false;
       }
       else{
           return true;
       }
   }//
   public function  checkMyMotto(Request $request){
       $count=DB::table('my_mottos')->where([
           ['openId','=',$request->input('openId')],
           ['mottos_id','=',$request->input('mottos_id')],
       ])->count();
       //已收藏1代表
       if($count>0){
           $result=array(
               'result'=>1
           );
           return response()->json($result);
       }
       else{
           //未收藏，0代表
           $result=array(
               'result'=>0
           );
           return response()->json($result);
       }
   }
}
