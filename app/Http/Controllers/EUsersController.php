<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EUsersController extends Controller
{
    //获取用户完整信息
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
            'created_at'=>date("Y-m-d H:i:s",time()),
            'updated_at'=>date("Y-m-d H:i:s",time())
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
               'created_at'=>date("Y-m-d H:i:s",time()),
               'updated_at'=>date("Y-m-d H:i:s",time())
           ]);
           return response()->json($result);
        }else{
            $result=$this->UpdateUserInfo($users);
            return response()->json($result);
        }
    }
    //只添加用户的OpenID,通过OpenID更新用户的最后登录信息
    public  function  onlyAddUserOpenid(Request $request){
        $users=array(
            'openId'=>$request->input('openId')
        );
        if($this->CheckUsers($users)){
            $result=DB::table('e_users')->insert([
                'openId'=>$request->input('openId'),
                'created_at'=>date("Y-m-d H:i:s",time()),
                'updated_at'=>date("Y-m-d H:i:s",time())
            ]);
            return response()->json($result);
        }else{
            $result=$this->OnlyUpdateUserUpdateTime($users);
            return response()->json($result);
        }
    }
    //判断是否是新用户，如果是新用户范围true
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
    public  function  getUserInfoByID(Request $request){
        $userInfo=DB::table('e_users')->where('openId',$request->input('openid'))->first();;
        return response()->json($userInfo);
    }
    public  function  OnlyUpdateUserUpdateTime($userInfo){
        date_default_timezone_set("Asia/Chongqing");
        $result=DB::table('e_users')
            ->where('openId', $userInfo['openId'])
            ->update([
                'updated_at'=>date("Y-m-d H:i:s",time())
            ]);
        return $result;
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
                'updated_at'=>date("Y-m-d H:i:s",time())
            ]);
        return $result;
    }
}
