<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Videos;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Curl\Curl;
class VideosController extends Controller
{
   public function addNewVideos(Request $request){
       $this->validate($request, [
           'video_title' => 'required',
           'video_poster'=>'required',
           'video_SDdataSize'=>'required',
           'video_HDdataSize'=>'required',
           'video_FHDdataSize'=>'required',
           'video_SDURL'=>'required',
           'video_HDURL'=>'required',
           'video_FHDURL'=>'required',
           'video_introduce'=>'required',
           'video_dialog_bg'=>'required',
           'video_dialog_english'=>'required',
           'video_dialog_chinese'=>'required',
           'video_goldenSentence'=>'required'
       ]);
       date_default_timezone_set("Asia/Chongqing");
       $video_title=$request->input('video_title');
       $video_poster=$request->input('video_poster');
       $video_SDdataSize=$request->input('video_SDdataSize');
       $video_HDdataSize=$request->input('video_HDdataSize');
       $video_FHDdataSize=$request->input('video_FHDdataSize');
       $video_SDURL=$request->input('video_SDURL');
       $video_HDURL=$request->input('video_HDURL');
       $video_FHDURL=$request->input('video_FHDURL');
       $video_introduce=$request->input('video_introduce');
       $video_dialog_bg=$request->input('video_dialog_bg');
       $video_dialog_english=$request->input('video_dialog_english');
       $video_dialog_chinese=$request->input('video_dialog_chinese');
       $video_goldenSentence=$request->input('video_goldenSentence');
       $created_at = date("Y-m-d H:i", time());
       $updated_at = date("Y-m-d H:i", time());
       $addResult = DB::table('videos')->insert(
           [
               'video_title'=>$video_title,'video_poster'=>$video_poster,'video_SDdataSize'=>$video_SDdataSize,
               'video_HDdataSize'=>$video_HDdataSize,'video_FHDdataSize'=>$video_FHDdataSize,
               'video_SDURL'=>$video_SDURL,'video_HDURL'=>$video_HDURL,'video_FHDURL'=>$video_FHDURL,
               'video_introduce'=>$video_introduce, 'video_dialog_bg'=>$video_dialog_bg,'video_dialog_english'=>$video_dialog_english,
               'video_dialog_chinese'=>$video_dialog_chinese,'video_goldenSentence'=>$video_goldenSentence,
               'created_at' => $created_at, 'updated_at' => $updated_at
           ]
       );
       if($addResult)
       {
           return redirect('/english/videosList');
       }
       else
       {
           return response()->json($addResult);
       }
   }//
   public function getNewVideo(){
       $newVideo=DB::select('select * from videos ORDER by id DESC  limit 1');
       return response()->json( $newVideo,200);
   }
   public function getVideoList(){
       $videoList=DB::table('videos')->orderBy('id','desc')->paginate(5);
       return response()->json($videoList,201);
   }
   public function updateVideo(Request $request,$id){
       $this->validate($request, [
           'video_title' => 'required'
       ]);
       date_default_timezone_set("Asia/Chongqing");
       $video_title=$request->input('video_title');
       $video_poster=$request->input('video_poster');
       $video_SDdataSize=$request->input('video_SDdataSize');
       $video_HDdataSize=$request->input('video_HDdataSize');
       $video_FHDdataSize=$request->input('video_FHDdataSize');
       $video_SDURL=$request->input('video_SDURL');
       $video_HDURL=$request->input('video_HDURL');
       $video_FHDURL=$request->input('video_FHDURL');
       $video_introduce=$request->input('video_introduce');
       $video_dialog_bg=$request->input('video_dialog_bg');
       $video_dialog_english=$request->input('video_dialog_english');
       $video_dialog_chinese=$request->input('video_dialog_chinese');
       $video_goldenSentence=$request->input('video_goldenSentence');
       $updated_at = date("Y-m-d H:i", time());
       $updateResult=DB::table('videos')->where('id',$id)->
       update([
           'video_title'=>$video_title,
           'video_poster'=>$video_poster,
           'video_SDdataSize'=>$video_SDdataSize,
           'video_HDdataSize'=>$video_HDdataSize,
           'video_FHDdataSize'=>$video_FHDdataSize,
           'video_SDURL'=>$video_SDURL,
           'video_HDURL'=>$video_HDURL,
           'video_FHDURL'=>$video_FHDURL,
           'video_introduce'=>$video_introduce,
           'video_dialog_bg'=>$video_dialog_bg,
           'video_dialog_english'=>$video_dialog_english,
           'video_dialog_chinese'=>$video_dialog_chinese,
           'video_goldenSentence'=>$video_goldenSentence,
           'updated_at'=>$updated_at
           ]);
       if($updateResult==1 || $updateResult==0)
       {
           return redirect('/english/videosList');
       }
       else {
           return response()->json($updateResult);
       }
   }
   public function delVideo($id){
        $DelResult=DB::table('videos')->where('id','=',$id)->delete();
        if($DelResult==1){
            return redirect('/english/videosList');
        }
        else
        {
            return response($DelResult);
        }
    }
   public function showVideo(Videos $Video){
      return $Video;
   }
}
