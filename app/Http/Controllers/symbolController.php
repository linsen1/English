<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/7/28
 * Time: 下午1:27
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


class symbolController extends  Controller
{
    //添加音标基础信息
    public function addSymbolBaseInfo(Request $request){
        $symbol=new Symbol();
        $symbol->title=$request->input("title");
        $symbol->type=$request->input("type");
        $symbol->orderflag=$request->input("orderflag");
        $symbol->typeflag=$request->input("typeflag");
        if($symbol->save())
        {
            return  response()->redirectTo('/english/symbol/symbolList/');
        }else {
            return response("false");
        }
    }
    //编辑音标基础信息
    public function  editSymbolBaseInfo(Request $request,$id){
        $symbol=Symbol::find($id);
        $symbol->title=$request->input("title");
        $symbol->type=$request->input("type");
        $symbol->orderflag=$request->input("orderflag");
        $symbol->typeflag=$request->input("typeflag");
        if($symbol->save()){
            return  response()->redirectTo('/english/symbol/symbolList/');
        }else{
            return response()->json("false");
        }
    }
    //删除音标基础信息
    public  function  delSymbol($id){
        $symbol=Symbol::find($id);
        if($symbol->delete()) {
            return response()->redirectTo("/english/symbol/symbolList");
        }else{
            return response()->json("false");
        }
    }
    /*
     * 添加音标基本内容
     */
    public  function  addSymbolContent(Request $request,$id){

        $symbolContent=new SymbolContent();
        $symbolContent->symbol_id=$id;
        $uploadFile=new fileHelper();
        $fileFolder='symbols/'.date('Y-m');
        //发音视频
        $speakVideoFileName=$uploadFile->upfile($request->file("speakVideo"));
        $speakVideoFilePath=Storage_path('app/uploads/'.$speakVideoFileName);
        $uploadFile->upBaiduCos($speakVideoFilePath,$speakVideoFileName,$fileFolder);//上传到百度云
        $speakVideoCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$speakVideoFileName;
        $symbolContent->speakVideo=$speakVideoCurrentUrl;

        //发音图片
        $speakImgUrlFileName=$uploadFile->upfile($request->file("speakImgUrl"));
        $speakImgUrlFilePath=Storage_path('app/uploads/'.$speakImgUrlFileName);
        $uploadFile->upBaiduCos($speakImgUrlFilePath,$speakImgUrlFileName,$fileFolder);//上传到百度云
        $speakImgUrlCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$speakImgUrlFileName;
        $symbolContent->speakImgUrl=$speakImgUrlCurrentUrl;

        $symbolContent->speakAbout=$request->input("speakAbout");
        $symbolContent->speakWord=$request->input("speakWord");

        //音标代言词图片
        $speakWordImgFileName=$uploadFile->upfile($request->file("speakWordImg"));
        $speakWordImgFilePath=Storage_path('app/uploads/'.$speakWordImgFileName);
        $uploadFile->upBaiduCos($speakWordImgFilePath,$speakWordImgFileName,$fileFolder);//上传到百度云
        $speakWordImgCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$speakWordImgFileName;
        $symbolContent->speakWordImg=$speakWordImgCurrentUrl;

        //音标代言词音频
        $speakWordMp3FileName=$uploadFile->upfile($request->file("speakWordMp3"));
        $speakWordMp3FilePath=Storage_path('app/uploads/'.$speakWordMp3FileName);
        $uploadFile->upBaiduCos($speakWordMp3FilePath,$speakWordMp3FileName,$fileFolder);//上传到百度云
        $speakWordMp3CurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$speakWordMp3FileName;
        $symbolContent->speakWordMp3=$speakWordMp3CurrentUrl;

        //代言词中文释义
        $symbolContent->speakWordChinese=$request->input("speakWordChinese");
        if($symbolContent->save()){
            return response()->redirectTo("/english/symbol/symbolContentList/".$id);
        }else{
            return response("false");
        }
    }

    /*
    * 编辑音标基本内容
    */
    public  function  editSymbolContent(Request $request,$id){

        $symbolContent=SymbolContent::find($id);
        $symbolContent->symbol_id=$id;
        $uploadFile=new fileHelper();
        $fileFolder='symbols/'.date('Y-m');
        //发音视频
        $speakVideoFileName=$uploadFile->upfile($request->file("speakVideo"));
        $speakVideoFilePath=Storage_path('app/uploads/'.$speakVideoFileName);
        $uploadFile->upBaiduCos($speakVideoFilePath,$speakVideoFileName,$fileFolder);//上传到百度云
        $speakVideoCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$speakVideoFileName;
        $symbolContent->speakVideo=$speakVideoCurrentUrl;

        //发音图片
        $speakImgUrlFileName=$uploadFile->upfile($request->file("speakImgUrl"));
        $speakImgUrlFilePath=Storage_path('app/uploads/'.$speakImgUrlFileName);
        $uploadFile->upBaiduCos($speakImgUrlFilePath,$speakImgUrlFileName,$fileFolder);//上传到百度云
        $speakImgUrlCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$speakImgUrlFileName;
        $symbolContent->speakImgUrl=$speakImgUrlCurrentUrl;

        $symbolContent->speakAbout=$request->input("speakAbout");
        $symbolContent->speakWord=$request->input("speakWord");

        //音标代言词图片
        $speakWordImgFileName=$uploadFile->upfile($request->file("speakWordImg"));
        $speakWordImgFilePath=Storage_path('app/uploads/'.$speakWordImgFileName);
        $uploadFile->upBaiduCos($speakWordImgFilePath,$speakWordImgFileName,$fileFolder);//上传到百度云
        $speakWordImgCurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$speakWordImgFileName;
        $symbolContent->speakWordImg=$speakWordImgCurrentUrl;

        //音标代言词音频
        $speakWordMp3FileName=$uploadFile->upfile($request->file("speakWordMp3"));
        $speakWordMp3FilePath=Storage_path('app/uploads/'.$speakWordMp3FileName);
        $uploadFile->upBaiduCos($speakWordMp3FilePath,$speakWordMp3FileName,$fileFolder);//上传到百度云
        $speakWordMp3CurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$speakWordMp3FileName;
        $symbolContent->speakWordMp3=$speakWordMp3CurrentUrl;

        //代言词中文释义
        $symbolContent->speakWordChinese=$request->input("speakWordChinese");
        if($symbolContent->save()){
            return response()->redirectTo("/english/symbol/symbolContentList/".$id);
        }else{
            return response("false");
        }
    }
    public  function  delSymbolContent($id,$listID){
        $symbolContent=SymbolContent::find($id);
        if($symbolContent->delete()) {
            return response()->redirectTo("/english/symbol/symbolContentList/" . $listID);
        }
        else
        {
            return response()->json("false");
        }
    }

    public  function  addWordsGroup(Request $request,$id){
        $this->validate($request, [
            'wordGroup' => 'required',
            'Words'=>'required'
        ]);
        $symbolWordsgroup=new SymbolWordsgroup();
        $symbolWordsgroup->wordGroup=$request->input("wordGroup");
        $symbolWordsgroup->Words=$request->input("Words");
        $symbolWordsgroup->symbol_id=$id;

        $uploadFile=new fileHelper();
        $fileFolder='symbols/'.date('Y-m');

        $WordsMp3FileName=$uploadFile->upfile($request->file("WordsMp3"));
        $WordsMp3FilePath=Storage_path('app/uploads/'.$WordsMp3FileName);
        $uploadFile->upBaiduCos($WordsMp3FilePath,$WordsMp3FileName,$fileFolder);//上传到百度云
        $WordsMp3CurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$WordsMp3FileName;

        $symbolWordsgroup->WordsMp3=$WordsMp3CurrentUrl;
        if($symbolWordsgroup->save()){
            return response()->redirectTo("/english/symbol/wordsGroupList/".$id);
        }else{
            return response()->json("false");
        }
    }
    //更新常见字母组合
    public  function  editWordsGroup(Request $request,$id,$PID){
        $this->validate($request, [
            'wordGroup' => 'required',
            'Words'=>'required'
        ]);

        $symbolWordsgroup=symbolWordsgroup::find($id);
        $symbolWordsgroup->wordGroup=$request->input("wordGroup");
        $symbolWordsgroup->Words=$request->input("Words");

        $uploadFile=new fileHelper();
        $fileFolder='symbols/'.date('Y-m');

        $WordsMp3FileName=$uploadFile->upfile($request->file("WordsMp3"));
        $WordsMp3FilePath=Storage_path('app/uploads/'.$WordsMp3FileName);
        $uploadFile->upBaiduCos($WordsMp3FilePath,$WordsMp3FileName,$fileFolder);//上传到百度云
        $WordsMp3CurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$WordsMp3FileName;

        $symbolWordsgroup->WordsMp3=$WordsMp3CurrentUrl;
        if($symbolWordsgroup->save()){
            return response()->redirectTo("/english/symbol/wordsGroupList/".$PID);
        }else{
            return response()->json("false");
        }
    }
    //添加常见单词
    public  function  addsymbolWords(Request $request,$id){
        $this->validate($request,[
            'ENword'=>'required',
            'wordSymbol'=>'required'
        ]);
        $symbolWords=new SymbolWord();
        $symbolWords->symbol_id=$id;
        $symbolWords->ENword=$request->input("ENword");
        $symbolWords->CNword=$request->input("CNword");
        $symbolWords->wordSymbol=$request->input("wordSymbol");

        $uploadFile=new fileHelper();
        $fileFolder='symbols/'.date('Y-m');

        $WordsMp3FileName=$uploadFile->upfile($request->file("ENwordMp3"));
        $WordsMp3FilePath=Storage_path('app/uploads/'.$WordsMp3FileName);
        $uploadFile->upBaiduCos($WordsMp3FilePath,$WordsMp3FileName,$fileFolder);//上传到百度云
        $WordsMp3CurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$WordsMp3FileName;

        $symbolWords->ENwordMp3=$WordsMp3CurrentUrl;
        if($symbolWords->save()){
            return response()->redirectTo("/english/symbol/symbolWordsList/".$id);
        }else{
            return response()->json("false");
        }
    }

    //编辑单词
    public  function editsymbolWords(Request $request,$id,$PID){
        $this->validate($request,[
            'ENword'=>'required',
            'wordSymbol'=>'required'
        ]);
        $symbolWords=SymbolWord::find($id);
        $symbolWords->ENword=$request->input("ENword");
        $symbolWords->CNword=$request->input("CNword");
        $symbolWords->wordSymbol=$request->input("wordSymbol");

        $uploadFile=new fileHelper();
        $fileFolder='symbols/'.date('Y-m');

        $WordsMp3FileName=$uploadFile->upfile($request->file("ENwordMp3"));
        $WordsMp3FilePath=Storage_path('app/uploads/'.$WordsMp3FileName);
        $uploadFile->upBaiduCos($WordsMp3FilePath,$WordsMp3FileName,$fileFolder);//上传到百度云
        $WordsMp3CurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$WordsMp3FileName;

        $symbolWords->ENwordMp3=$WordsMp3CurrentUrl;
        if($symbolWords->save()){
            return response()->redirectTo("/english/symbol/symbolWordsList/".$PID);
        }else{
            return response()->json("false");
        }
    }

    public  function  delsymbolWords($id,$PID){
        $symbolWords=SymbolWord::find($id);
        if($symbolWords->delete()) {
            return response()->redirectTo("/english/symbol/symbolWordsList/".$PID);
        }else{
            return response()->json("false");
        }
    }

//添加英文短语
    public function  addSymbolPhrase(Request $request,$id){
        $this->validate($request,[
            'ENPhrase'=>'required',
            'CNPhrase'=>'required'
        ]);
        $symbolPhrase=new SymbolPhrase();
        $symbolPhrase->ENPhrase=$request->input("ENPhrase");
        $symbolPhrase->CNPhrase=$request->input("CNPhrase");
        $symbolPhrase->symbol_id=$id;

        $uploadFile=new fileHelper();
        $fileFolder='symbols/'.date('Y-m');

        $PhraseMp3FileName=$uploadFile->upfile($request->file("PhraseMp3"));
        $PhraseMp3FilePath=Storage_path('app/uploads/'.$PhraseMp3FileName);
        $uploadFile->upBaiduCos($PhraseMp3FilePath,$PhraseMp3FileName,$fileFolder);//上传到百度云
        $PhraseMp3CurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$PhraseMp3FileName;

        $symbolPhrase->PhraseMp3=$PhraseMp3CurrentUrl;
        if($symbolPhrase->save()) {
            return response()->redirectTo("/english/symbol/symbolPhraseList/".$id);
        }else{
            return response()->json("false");
        }
    }
    //编辑短语
    public function editSymbolPhrase(Request $request,$id,$PID){
        $this->validate($request,[
            'ENPhrase'=>'required',
            'CNPhrase'=>'required'
        ]);
        $symbolPhrase=SymbolPhrase::find($id);
        $symbolPhrase->ENPhrase=$request->input("ENPhrase");
        $symbolPhrase->CNPhrase=$request->input("CNPhrase");


        $uploadFile=new fileHelper();
        $fileFolder='symbols/'.date('Y-m');

        $PhraseMp3FileName=$uploadFile->upfile($request->file("PhraseMp3"));
        $PhraseMp3FilePath=Storage_path('app/uploads/'.$PhraseMp3FileName);
        $uploadFile->upBaiduCos($PhraseMp3FilePath,$PhraseMp3FileName,$fileFolder);//上传到百度云
        $PhraseMp3CurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$PhraseMp3FileName;

        $symbolPhrase->PhraseMp3=$PhraseMp3CurrentUrl;
        if($symbolPhrase->save()) {
            return response()->redirectTo("/english/symbol/symbolPhraseList/".$PID);
        }else{
            return response()->json("false");
        }
    }
    public function  delSymbolPhrase($id,$PID){
        $symbolPhrase=SymbolPhrase::find($id);
        if($symbolPhrase->delete()) {
            return response()->redirectTo("/english/symbol/symbolPhraseList/".$PID);
        }else{
            return response()->json("false");
        }
    }

    //添加句子相关业务逻辑
    public function addSymbolSentence($id,Request $request){
        $this->validate($request,[
            'ENSentence'=>'required',
            'CNSentence'=>'required'
        ]);
        $symbolSentence=new SymbolSentence();
        $symbolSentence->ENSentence=$request->input("ENSentence");
        $symbolSentence->CNSentence=$request->input("CNSentence");
        $symbolSentence->symbol_id=$id;

        $uploadFile=new fileHelper();
        $fileFolder='symbols/'.date('Y-m');

        $SentenceMp3FileName=$uploadFile->upfile($request->file("SentenceMp3"));
        $SentenceMp3FilePath=Storage_path('app/uploads/'.$SentenceMp3FileName);
        $uploadFile->upBaiduCos($SentenceMp3FilePath,$SentenceMp3FileName,$fileFolder);//上传到百度云
        $SentenceMp3CurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$SentenceMp3FileName;

        $symbolSentence->SentenceMp3=$SentenceMp3CurrentUrl;
        if($symbolSentence->save()) {
            return response()->redirectTo("/english/symbol/symbolSentenceList/".$id);
        }else{
            return response()->json("false");
        }
    }
    //编辑句子
    public function  editSymbolSentence(Request $request,$id,$PID){
        $this->validate($request,[
            'ENSentence'=>'required',
            'CNSentence'=>'required'
        ]);
        $symbolSentence=SymbolSentence::find($id);
        $symbolSentence->ENSentence=$request->input("ENSentence");
        $symbolSentence->CNSentence=$request->input("CNSentence");


        $uploadFile=new fileHelper();
        $fileFolder='symbols/'.date('Y-m');

        $SentenceMp3FileName=$uploadFile->upfile($request->file("SentenceMp3"));
        $SentenceMp3FilePath=Storage_path('app/uploads/'.$SentenceMp3FileName);
        $uploadFile->upBaiduCos($SentenceMp3FilePath,$SentenceMp3FileName,$fileFolder);//上传到百度云
        $SentenceMp3CurrentUrl=config('appkey.baiduCos.Cos_Host').$fileFolder.'/'.$SentenceMp3FileName;

        $symbolSentence->SentenceMp3=$SentenceMp3CurrentUrl;
        if($symbolSentence->save()) {
            return response()->redirectTo("/english/symbol/symbolSentenceList/".$PID);
        }else{
            return response()->json("false");
        }
    }
    public function  delSymbolSentence($id,$PID){
        $symbolSentence=SymbolSentence::find($id);
        if($symbolSentence->delete()) {
            return response()->redirectTo("/english/symbol/symbolSentenceList/".$PID);
        }else{
            return response()->json("false");
        }
    }

    //添加歌曲
    public  function  addSong(Request $request,$id){
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
        $song->ref_id=$id;
        $song->type=0;

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

    //显示小程序音标基础列表
    public  function  symbolBaseList(){
        $symbol=Symbol::all();
        return response()->json($symbol);
    }
    //显示音标基本信息
    public function getSymbolBaseByID($id){
        $Symbol=Symbol::find($id);
        return  response()->json($Symbol);
    }
    //显示音标基础内容
    public  function  getSymbolBaseContentByID($refID){
        $symbolContent=SymbolContent::where("symbol_id",$refID)->first();
        return response()->json( $symbolContent);
    }
    //显示音标字幕组合
    public  function  getSymbolWordsGroupByID($refID){
        $symbolWordsgroup=SymbolWordsgroup::where("symbol_id",$refID)->get();
        return response()->json($symbolWordsgroup);
    }
    //显示音标相关单词
    public  function  getSymbolWordsByID($refID){
        $symbolWords=SymbolWord::where("symbol_id",$refID)->get();
        return response()->json($symbolWords);
    }
    //显示音标相关短语
    public  function  getSymbolPhrasesByID($refID){
        $symbolPhrase=SymbolPhrase::where("symbol_id",$refID)->get();
        return response()->json($symbolPhrase);
    }
    //显示音标相关句子
    public  function  getSymbolSentenceByID($refID){
        $symbolSentence=SymbolSentence::where("symbol_id",$refID)->get();
        return response()->json($symbolSentence);
    }
    //显示相关歌曲
    public  function  getSymbolSongByID($refID){
        $song=Song::where("ref_id",$refID)->get();
        return response()->json($song);
    }
    public  function  getsongInfoByID($ID){
        $song=Song::find($ID);
        return response()->json($song);
    }
}