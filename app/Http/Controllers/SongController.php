<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/8/25
 * Time: 下午2:50
 */
namespace App\Http\Controllers;
use Hamcrest\Core\SampleSubClass;
use Illuminate\Http\Request;
use App\baiduHelper\AipSpeech ;
use App\baiduHelper\Translate;
use Illuminate\Support\Facades\DB;
use App\symbol;
use App\SymbolContent;
use App\symbolWordsgroup;
use App\commonHelper\fileHelper;
use App\SymbolWord;
use App\SymbolPhrase;
use App\SymbolSentence;
use App\Song;

class SongController extends  Controller{
    public  function  addSong(Request $request){
        $this->validate($request,[
            'songName'=>'required'
        ]);
        $song=new Song();
        $song->songName=$request->input("songName");

        $uploadFile=new fileHelper();
        $fileFolder='symbols/song/'.date('Y-m');

        //音乐缩略图
        $songImgSmallFileName=$uploadFile->upfile($request->file("songImgSmall"));
        $songImgSmallFilePath=Storage_path('app/uploads/'.$songImgSmallFileName);
        $uploadFile->upBaiduCos($songImgSmallFilePath,$songImgSmallFileName,$fileFolder);//上传到百度云
        $songImgSmallCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$songImgSmallFileName;
        $song->songImgSmall=$songImgSmallCurrentUrl;
        //音乐封面图
        $songImgBigFileName=$uploadFile->upfile($request->file("songImgBig"));
        $songImgBigFilePath=Storage_path('app/uploads/'.$songImgBigFileName);
        $uploadFile->upBaiduCos($songImgBigFilePath,$songImgBigFileName,$fileFolder);//上传到百度云
        $songImgBigCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$songImgBigFileName;
        $song->songImgBig=$songImgBigCurrentUrl;
        //音乐MP3音频地址
        $songMp3FileName=$uploadFile->upfile($request->file("songMp3"));
        $songMp3FilePath=Storage_path('app/uploads/'.$songMp3FileName);
        $uploadFile->upBaiduCos($songMp3FilePath,$songMp3FileName,$fileFolder);//上传到百度云
        $songMp3CurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$songMp3FileName;
        $song->songMp3=$songMp3CurrentUrl;
        //音乐MP3(HD)音频地址
        $songMp3HDFileName=$uploadFile->upfile($request->file("songMp3HD"));
        $songMp3HDFilePath=Storage_path('app/uploads/'.$songMp3HDFileName);
        $uploadFile->upBaiduCos($songMp3HDFilePath,$songMp3HDFileName,$fileFolder);//上传到百度云
        $songMp3HDCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$songMp3HDFileName;
        $song->songMp3HD=$songMp3HDCurrentUrl;

        $song->singer=$request->input("singer");

        //歌手图片
        $singerImgFileName=$uploadFile->upfile($request->file("singerImg"));
        $singerImgFilePath=Storage_path('app/uploads/'.$singerImgFileName);
        $uploadFile->upBaiduCos($singerImgFilePath,$singerImgFileName,$fileFolder);//上传到百度云
        $singerImgCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$singerImgFileName;
        $song->singerImg=$singerImgCurrentUrl;

        $song->singerabout=$request->input("singerabout");
        $song->songAbout=$request->input("songAbout");
        $song->ENSong=$request->input("ENSong");
        $song->CNSong=$request->input("CNSong");
        $song->type=1;

        if($song->save()) {
            return response()->redirectTo("/english/symbol/songsList/".$id);
        }else{
            return response()->json("false");
        }
    }

    public  function  editSong(Request $request,$id,$PID){
        $this->validate($request,[
            'songName'=>'required'
        ]);
        $song=Song::find($id);
        $song->songName=$request->input("songName");

        $uploadFile=new fileHelper();
        $fileFolder='symbols/song/'.date('Y-m');

        //音乐缩略图
        $songImgSmallFileName=$uploadFile->upfile($request->file("songImgSmall"));
        $songImgSmallFilePath=Storage_path('app/uploads/'.$songImgSmallFileName);
        $uploadFile->upBaiduCos($songImgSmallFilePath,$songImgSmallFileName,$fileFolder);//上传到百度云
        $songImgSmallCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$songImgSmallFileName;
        $song->songImgSmall=$songImgSmallCurrentUrl;
        //音乐封面图
        $songImgBigFileName=$uploadFile->upfile($request->file("songImgBig"));
        $songImgBigFilePath=Storage_path('app/uploads/'.$songImgBigFileName);
        $uploadFile->upBaiduCos($songImgBigFilePath,$songImgBigFileName,$fileFolder);//上传到百度云
        $songImgBigCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$songImgBigFileName;
        $song->songImgBig=$songImgBigCurrentUrl;
        //音乐MP3音频地址
        $songMp3FileName=$uploadFile->upfile($request->file("songMp3"));
        $songMp3FilePath=Storage_path('app/uploads/'.$songMp3FileName);
        $uploadFile->upBaiduCos($songMp3FilePath,$songMp3FileName,$fileFolder);//上传到百度云
        $songMp3CurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$songMp3FileName;
        $song->songMp3=$songMp3CurrentUrl;
        //音乐MP3(HD)音频地址
        $songMp3HDFileName=$uploadFile->upfile($request->file("songMp3HD"));
        $songMp3HDFilePath=Storage_path('app/uploads/'.$songMp3HDFileName);
        $uploadFile->upBaiduCos($songMp3HDFilePath,$songMp3HDFileName,$fileFolder);//上传到百度云
        $songMp3HDCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$songMp3HDFileName;
        $song->songMp3HD=$songMp3HDCurrentUrl;

        $song->singer=$request->input("singer");

        //歌手图片
        $singerImgFileName=$uploadFile->upfile($request->file("singerImg"));
        $singerImgFilePath=Storage_path('app/uploads/'.$singerImgFileName);
        $uploadFile->upBaiduCos($singerImgFilePath,$singerImgFileName,$fileFolder);//上传到百度云
        $singerImgCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$singerImgFileName;
        $song->singerImg=$singerImgCurrentUrl;

        $song->singerabout=$request->input("singerabout");
        $song->songAbout=$request->input("songAbout");
        $song->ENSong=$request->input("ENSong");
        $song->CNSong=$request->input("CNSong");

        $song->type=0;

        if($song->save()) {
            return response()->redirectTo("/english/symbol/songsList/".$PID);
        }else{
            return response()->json("false");
        }
    }

    public  function  delSong($id,$PID){
        $song=Song::find($id);
        if($song->delete()) {
            return response()->redirectTo("/english/symbol/songsList/".$PID);
        }else{
            return response()->json("false");
        }
    }

    public  function  allSong(){
        $songsList=Song::where([
            ["id",">",0]
        ])->orderby('id','desc')->paginate(10);
        return response()->json($songsList);
    }
}