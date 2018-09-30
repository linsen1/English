<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/9/30
 * Time: 下午2:29
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Homebanners;
use App\commonHelper\fileHelper;


class HomeBannerController extends  Controller
{
    public  function addBanner(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'imgurl'=>'required',
            'ref_id'=>'required'
        ]);
        $banner=new Homebanners();
        $banner->title=$request->input("title");
        $banner->type=$request->input("type");
        $banner->ref_id=$request->input("ref_id");

        $uploadFile=new fileHelper();
        $fileFolder='homeBanner/'.date('Y-m');
        $imgurlFileName=$uploadFile->upfile($request->file("imgurl"));
        $imgurlFilePath=Storage_path('app/uploads/'.$imgurlFileName);
        $uploadFile->upBaiduCos($imgurlFilePath,$imgurlFileName,$fileFolder);//上传到百度云
        $imgurlCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$imgurlFileName;
        $banner->imgurl=$imgurlCurrentUrl;

        $result=$banner->save();
        if($result){
            return response()->redirectTo("/english/homeBanners/list");
        }else{
            return response()->json("false");
        }
    }

    public  function  delBanner($id){
        $homeBanner=Homebanners::find($id);
        $result=$homeBanner->delete();
        if($result){
            return response()->redirectTo("/english/homeBanners/list");
        }
        else{
            return response()->json("false");
        }
    }
    public  function  editBanner(Request $request,$id){
        $banner=Homebanners::find($id);
        $this->validate($request,[
            'title'=>'required',
            'imgurl'=>'required',
            'ref_id'=>'required'
        ]);
        $banner->title=$request->input("title");
        $banner->type=$request->input("type");
        $banner->ref_id=$request->input("ref_id");

        $uploadFile=new fileHelper();
        $fileFolder='homeBanner/'.date('Y-m');
        $imgurlFileName=$uploadFile->upfile($request->file("imgurl"));
        $imgurlFilePath=Storage_path('app/uploads/'.$imgurlFileName);
        $uploadFile->upBaiduCos($imgurlFilePath,$imgurlFileName,$fileFolder);//上传到百度云
        $imgurlCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$imgurlFileName;
        $banner->imgurl=$imgurlCurrentUrl;

        $result=$banner->save();
        if($result){
            return response()->redirectTo("/english/homeBanners/list");
        }else{
            return response()->json("false");
        }
    }
}