<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MyMottosController extends Controller
{
   public function AddUserMotto(Request $request){
       $userMottos=array([
           'openId'=>$request->input('openId'),
       ]);
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
}
