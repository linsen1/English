<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/10/14
 * Time: 上午10:28
 */

namespace App\Http\Controllers;
use App\commonHelper\fileHelper;
use Illuminate\Http\Request;
use App\story;
use App\storyClass;

class StoryController extends  Controller
{
    public  function  addStory(Request $request){
       $this->validate($request,[
           'storyTitle'=>'required'
       ]);
       $story=new story();

       $story->storyTitle=$request->input("storyTitle");
       $story->storyClassID=$request->input("storyClassID");

       $uploadFile=new fileHelper();
       $fileFolder='story/'.date('Y-m');
        //上传故事图片
       $storyImgFileName=$uploadFile->upfile($request->file("storyImg"));
       $storyImgFilePath=Storage_path('app/uploads/'.$storyImgFileName);
       $uploadFile->upBaiduCos($storyImgFilePath,$storyImgFileName,$fileFolder);//上传到百度云
       $storyImgCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$storyImgFileName;
       $story->storyImg=$storyImgCurrentUrl;
       //上传故事音频
        $storyAudioFileName=$uploadFile->upfile($request->file("storyAudio"));
        $storyAudioFilePath=Storage_path('app/uploads/'.$storyAudioFileName);
        $uploadFile->upBaiduCos($storyAudioFilePath,$storyAudioFileName,$fileFolder);//上传到百度云
        $storyAudioCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$storyAudioFileName;
        $story->storyAudio=$storyAudioCurrentUrl;

        $story->storyabout=$request->input("storyabout");
        $story->storyEN=$request->input("storyEN");
        $story->storyCN=$request->input("storyCN");
        $story->storyENCN=$request->input("storyENCN");

        $result=$story->Save();
        if($result){
            return response()->redirectTo('/english/story/list');
        }else{
            return response()->json("false");
        }
    }

    public function  editStory(Request $request,$id){
        $this->validate($request,[
            'storyTitle'=>'required'
        ]);
        $story=story::find($id);

        $story->storyTitle=$request->input("storyTitle");
        $story->storyClassID=$request->input("storyClassID");

        $uploadFile=new fileHelper();
        $fileFolder='story/'.date('Y-m');
        //上传故事图片
        $storyImgFileName=$uploadFile->upfile($request->file("storyImg"));
        $storyImgFilePath=Storage_path('app/uploads/'.$storyImgFileName);
        $uploadFile->upBaiduCos($storyImgFilePath,$storyImgFileName,$fileFolder);//上传到百度云
        $storyImgCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$storyImgFileName;
        $story->storyImg=$storyImgCurrentUrl;
        //上传故事音频
        $storyAudioFileName=$uploadFile->upfile($request->file("storyAudio"));
        $storyAudioFilePath=Storage_path('app/uploads/'.$storyAudioFileName);
        $uploadFile->upBaiduCos($storyAudioFilePath,$storyAudioFileName,$fileFolder);//上传到百度云
        $storyAudioCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$storyAudioFileName;
        $story->storyAudio=$storyAudioCurrentUrl;

        $story->storyabout=$request->input("storyabout");
        $story->storyEN=$request->input("storyEN");
        $story->storyCN=$request->input("storyCN");
        $story->storyENCN=$request->input("storyENCN");

        $result=$story->Save();
        if($result){
            return response()->redirectTo('/english/story/list');
        }else{
            return response()->json("false");
        }
    }

    public function  delStory($id){
        $story=story::find($id);
        $result=$story->delete();
        if($result){
            return response()->redirectTo('/english/story/list');
        }else{
            return response()->json("false");
        }
    }

    public  function  storyList(){
        $storyList=story::orderBy('id','desc')->paginate(5);
        return response()->json($storyList);
    }

    public  function  showStory($id){
        $story=story::find($id);
        return response()->json($story);
    }
    public  function  showStoryClass($id){
        $storyClass=storyClass::find($id);
        return response()->json($storyClass);
    }
}