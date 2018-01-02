<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EUsersController extends Controller
{
    public  function  AddUsers(Request $request){
        date_default_timezone_set("Asia/Chongqing");
        $users=array(
            'openId'=>$request->input('openId'),
            'nickName'=>$request->input('nickName'),
            'gender'=>$request->input('gender'),
            'language'=>$request->input('language'),
            'city'=>$request->input('city'),
            'province'=>$request->input('province'),
            'country'=>$request->input('country'),
            'avatarUrl'=>$request->input('avatarUrl'),
            'created_at'=>date("Y-m-d H:i",time()),
            'updated_at'=>date("Y-m-d H:i",time())
        );
        if($this->CheckUsers($users)){
           $result=DB::table('e_users')->insert([
               'openId'=>$request->input('openId'),
               'nickName'=>$request->input('nickName'),
               'gender'=>$request->input('gender'),
               'language'=>$request->input('language'),
               'city'=>$request->input('city'),
               'province'=>$request->input('province'),
               'country'=>$request->input('country'),
               'avatarUrl'=>$request->input('avatarUrl'),
               'created_at'=>date("Y-m-d H:i",time()),
               'updated_at'=>date("Y-m-d H:i",time())
           ]);
           return response()->json($result);
        }else{
            $result=$this->UpdateUserInfo($users);
            return response()->json($result);
        }
    }
    public  function CheckUsers($userInfo){
        $count=DB::table('e_users')->where('openId',$userInfo['openId'])->count();
        if($count>0) {
            return false;
        }
        else
        {
            return true;
        }
    }
    public  function  UpdateUserInfo($userInfo){
        date_default_timezone_set("Asia/Chongqing");
        $result=DB::table('e_users')
            ->where('openId', $userInfo['openId'])
            ->update([
                'nickName' => $userInfo['nickName'],
                'gender'=>$userInfo['gender'],
                'language'=>$userInfo['language'],
                'city'=>$userInfo['city'],
                'province'=>$userInfo['province'],
                'country'=>$userInfo['country'],
                'avatarUrl'=>$userInfo['avatarUrl'],
                'updated_at'=>date("Y-m-d H:i",time())
            ]);
        return $result;
    }
}
