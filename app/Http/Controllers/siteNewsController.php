<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/9/30
 * Time: 下午12:16
 */

namespace App\Http\Controllers;
use App\commonHelper\fileHelper;
use Illuminate\Http\Request;
use App\siteNews;


class siteNewsController extends  Controller
{
    //添加新闻
    public  function  addNew(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'contents'=>'required',
            'bannerUrl'=>'required'
        ]);
        $siteNews=new siteNews();
        $siteNews->title=$request->input('title');
        $siteNews->contents=$request->input('contents');

        $uploadFile=new fileHelper();
        $fileFolder='siteNews/'.date('Y-m');
        $bannerUrlFileName=$uploadFile->upfile($request->file("bannerUrl"));
        $bannerUrlFilePath=Storage_path('app/uploads/'.$bannerUrlFileName);
        $uploadFile->upBaiduCos($bannerUrlFilePath,$bannerUrlFileName,$fileFolder);//上传到百度云
        $bannerUrlCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$bannerUrlFileName;
        $siteNews->bannerUrl=$bannerUrlCurrentUrl;

        $result=$siteNews->save();
        if($result){
            return response()->redirectTo('/english/siteNews/list/');
        }else
        {
            return response()->json("false");
        }
    }

    //删除新闻
    public  function  delNew($id){
        $new=siteNews::find($id);
        $result=$new->delete();
        if($result){
            return response()->redirectTo('/english/siteNews/list/');
        }else{
            return response()->json("false");
        }
    }

    public  function  editNew(Request $request,$id){
        $siteNews=siteNews::find($id);
        $this->validate($request,[
            'title'=>'required',
            'contents'=>'required',
            'bannerUrl'=>'required'
        ]);
        $siteNews->title=$request->input('title');
        $siteNews->contents=$request->input('contents');

        $uploadFile=new fileHelper();
        $fileFolder='symbols/siteNews/'.date('Y-m');
        $bannerUrlFileName=$uploadFile->upfile($request->file("bannerUrl"));
        $bannerUrlFilePath=Storage_path('app/uploads/'.$bannerUrlFileName);
        $uploadFile->upBaiduCos($bannerUrlFilePath,$bannerUrlFileName,$fileFolder);//上传到百度云
        $bannerUrlCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$bannerUrlFileName;
        $siteNews->bannerUrl=$bannerUrlCurrentUrl;

        $result=$siteNews->save();
        if($result){
            return response()->redirectTo('/english/siteNews/list/');
        }else
        {
            return response()->json("false");
        }
    }

    public  function  showNews($id){
        $siteNews=siteNews::find($id);
        return response()->json($siteNews);
    }
    public function  newsList(){
        $infolist=siteNews::where("id",">",0)
            ->orderby('id','desc')->paginate(5);
        return response()->json($infolist);
    }
}