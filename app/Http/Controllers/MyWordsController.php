<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class MyWordsController extends Controller
{
    public  function  AddMyWords(Request $request){
        date_default_timezone_set("Asia/Chongqing");
        $userWords=array(
            "openId"=>$request->input('openId'),
            "word_id"=>$request->input('word_id')
        );
        if($this->CheckMyWords($userWords)){
            $result=DB::table('my_words')->insert([
                'openId'=>$request->input('openId'),
                'word_id'=>$request->input('word_id'),
                'created_at'=>date("Y-m-d H:i",time()),
                'updated_at'=>date("Y-m-d H:i",time())
            ]);
            $result1=array(
                'result'=>$result
            );
            return response()->json($result1);
        }else{
            $result=array(
                'result'=>0
            );
            return response()->json($result);
        }
    }//
    public  function DelMyWords(Request $request){
        $result=DB::table('my_words')->where([
            ['openId','=',$request->input('openId')],
            ['word_id','=',$request->input('word_id')]
        ])->delete();
        return response()->json($result);
    }
    public  function CheckMyWords($userWords){
        $count=DB::table('my_words')->where([
            ['openId','=',$userWords['openId']],
            ['word_id','=',$userWords['word_id']]
        ])->count();
        if($count>0){
            return false;
        }else
        {
            return true;
        }
    }
    public  function CheckIfMyWords(Request $request){
        $count=DB::table('my_words')->where([
            ['openId','=',$request->input('openId')],
            ['word_id','=',$request->input('word_id')]
        ])->count();
        if($count>0){
            $result=array(
                'result'=>1
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
}
