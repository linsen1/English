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
           'mottos_id'=>$request->input('mottos_id'),
           'type'=>$request->input('type',0)
       );
       if($this->checkUserMotto($userMottos)){
           $result=DB::table('my_mottos')->insert([
               'openId'=>$request->input('openId'),
               'mottos_id'=>$request->input('mottos_id'),
               'type'=>$request->input('type',0),
               'created_at'=>date("Y-m-d H:i:s",time()),
               'updated_at'=>date("Y-m-d H:i:s",time())
           ]);
           $result=array(
               'result'=>$result
           );
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
           ['type','=',$mottos['type']]
       ])->count();
       if($count>0){
           return false;
       }
       else{
           return true;
       }
   }//
    public  function DelMyMotto(Request $request){
        $result=DB::table('my_mottos')->where([
            ['openId','=',$request->input('openId')],
            ['mottos_id','=',$request->input('mottos_id')],
            ['type','=',$request->input('type','0')]
        ])->delete();
        return response()->json($result);
    }
   public function  checkMyMotto(Request $request){
       $count=DB::table('my_mottos')->where([
           ['openId','=',$request->input('openId')],
           ['mottos_id','=',$request->input('mottos_id')],
           ['type','=',$request->input('type',0)]
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
    public function GetMyMottoList(Request $request)
    {
        $type=$request->input('type',0);
        if($type==0) {
            $newList = DB::table('my_mottos')
                ->Join('mottos', 'my_mottos.mottos_id', '=', 'mottos.id')
                ->where([
                    ['my_mottos.openId', '=', $request->input('openId')],
                    ['my_mottos.type','=',0]
                ])
                ->orderBy('mottos.id', 'desc')->paginate(5);
            return response()->json($newList, 201);
        }
        elseif ($type==1){
            $newList = DB::table('my_mottos')->Join('articles', 'my_mottos.mottos_id', '=', 'articles.id')
                ->where([
                    ['my_mottos.openId', '=', $request->input('openId')],
                    ['my_mottos.type','=',1]
                ])
                ->orderBy('articles.id', 'desc')->paginate(5);
            return response()->json($newList, 201);
        }
        else
        {
            $newList = DB::table('my_mottos')->Join('videos', 'my_mottos.mottos_id', '=', 'videos.id')
                ->where([
                    ['my_mottos.openId', '=', $request->input('openId')],
                    ['my_mottos.type','=',2]
                ])
                ->orderBy('videos.id', 'desc')->paginate(5);
            return response()->json($newList, 201);
        }
    }

}
