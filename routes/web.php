<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\symbol;
use App\symbolContent;
use App\symbolWordsgroup;
use App\SymbolWord;
USE App\symbolPhrase;
use App\symbolSentence;
use App\Song;

Route::get('/english/mottoAdd', function () {
    return view('welcome');
});
Route::get('/english/mottoList',function (){
    $mottoList=DB::table('mottos')->orderBy('id','desc')->paginate(5);
   return view('mottoList',['mottoList'=>$mottoList]);
});
Route::get('/english/editMotto/{id}',function ($id){
    $motto=DB::select('select * from mottos where id=?',[$id]);
    //return response()->json( $motto,201);
    return view('english.editMotto',['motto'=>$motto]);
});
Route::get('/motto/add', function () {
    return view('addmotto');
});


/*
 *
 */
Route::get('/english/addNewWord/{id}/type/{no}',function ($id,$no){
    return view('english.addNewWord',['id'=>$id,'no'=>$no]);
});
Route::get('/english/editNewWordList/{id}/type/{no}',function($id,$no){
    $wordList=DB::table('new_words')->where(['mottoId'=>$id,'type'=>$no])->orderBy('id','desc')->paginate(10);
    return view('english.newWordList',['wordList'=>$wordList,'id'=>$id,'no'=>$no]);
});
Route::get('/english/editNewWord/{id}/mottoID/{mottoID}/type/{no}',function ($id,$mottoID,$no){
    $word=DB::select('select * from  new_words where id=?',[$id]);
    return view('english.editNewWord',['word'=>$word[0],'mottoID'=>$mottoID,'id'=>$id,'no'=>$no]);
});

Route::get('/english/addVideo',function (){
    return view('english.addNewVideo');
});
Route::get('/english/videosList',function (){
    $videosList=DB::table('videos')->orderBy('id','desc')->paginate(5);
    return view('english.videosList',['videosList'=>$videosList]);
});
Route::get('/english/editVideoInfo/{id}',function($id){
    $videoinfo=DB::table('videos')->where('id',$id)->get();
    return view('english.editVideoInfo',['videoinfo'=>$videoinfo,'id'=>$id]);
});

//美文添加逻辑
Route::get('/english/addNewArticle',function(){
    return view('english.addNewArticle');
});
Route::get('/english/articleList',function(){
    $articles=DB::table('articles')->orderBy('id','desc')->paginate(5);
    return view('english.articleList',['articles'=>$articles]);
});
Route::get('/english/editArticleInfo/{id}',function($id){
    $articleinfo=DB::table('articles')->where('id',$id)->get();
    return view('english.editArticleInfo',['articleInfo'=>$articleinfo,'id'=>$id]);
});

//添加短语逻辑
Route::get('/english/editSentenceList/{RefID}/type/{no}',function($RefID,$no){
    $SentenceList=DB::table('sentences')->where(['refID'=>$RefID,'type'=>$no])->orderBy('id','desc')->paginate(10);
    return view('english.SentenceList',['SentenceList'=>$SentenceList,'RefID'=>$RefID,'no'=>$no]);
});
Route::get('/english/addNewSentence/{refID}/type/{type}',function ($refID,$type){
    return view('english.addNewSentence',['refID'=>$refID,'type'=>$type]);
});
Route::get('/english/editSentence/id/{id}/refID/{refID}/type/{type}',function ($id,$refID,$type){

    $sentenceInfo=DB::table('sentences')->where('id',$id)->get();
    //return response()->json($sentenceInfo);
    return view('english.editSentence',['sentenceInfo'=>$sentenceInfo[0],'refID'=>$refID,'type'=>$type,'id'=>$id]);
});

//音标业务模块
Route::prefix('english/symbol')->group(function () {
    Route::get('symbolList', function () {
        $symbolList=DB::table('symbols')->orderBy('id','desc')->paginate(10);
        return view('english.symbolList',['symbols'=>$symbolList]);
        // Matches The "/admin/users" URL
    });
    Route::get("addSymbol",function (){
       return view('english.addSymbol');
    });
    Route::get("editSymbol/{id}",function ($id){
        $symbol=Symbol::find($id);
        return view("english.editSymbol",["symbol"=>$symbol]);
    });
    //添加音标基本内容
    Route::get("addSymbolContent/{id}",function ($id){
       return view('english.addSymbolContent',["id"=>$id]);
    });
    //编辑音标基本内容
    Route::get("editSymbolContent/{id}",function ($id){
        $symbolContent=SymbolContent::find($id);
        return view('english.editSymbolContent',["id"=>$id,"symbolContent"=>$symbolContent]);
    });
    //音标基本内容管理
    Route::get("symbolContentList/{id}",function ($id){
        $symbolContent=SymbolContent::where('symbol_id',$id)->paginate(10);
       return view('english.symbolContentList',['id'=>$id,"symbolContent"=>$symbolContent]);
    });
    //字母组合列表
    Route::get("wordsGroupList/{id}",function ($id){
        $symbolWordsgroup=SymbolWordsgroup::where("symbol_id",$id)->paginate(10);
        return view('english.wordsGroupList',["id"=>$id,"symbolWordsgroup"=>$symbolWordsgroup]);
    });
    Route::get("addWordsgroup/{id}",function ($id){
        return view('english.addWordsgroup',["id"=>$id]);
    });
    Route::get("editWordsGroup/{id}/PID/{PID}",function ($id,$PID){
        $symbolWordsgroup=SymbolWordsgroup::find($id);
        return view('english.editWordsGroup',["id"=>$id,"PID"=>$PID,"symbolWordsgroup"=>$symbolWordsgroup]);
    });
    //单词管理列表
    Route::get("symbolWordsList/{id}",function ($id){
        $symbolWordsList=SymbolWord::where("symbol_id",$id)->paginate(10);
        return view("english.symbolWordsList",["id"=>$id,"symbolWordsList"=>$symbolWordsList]);
    });
    //添加单词
    Route::get("addsymbolWords/{id}",function ($id){
        return view("english.addsymbolWords",["id"=>$id]);
    });
    Route::get("editsymbolWord/{id}/PID/{PID}",function ($id,$PID){
        $symbolWord=SymbolWord::find($id);
       return view("english.editsymbolWord",["id"=>$id,"PID"=>$PID,"symbolWord"=>$symbolWord]);
    });

    //短语管理
    Route::get("symbolPhraseList/{id}",function ($id){
        $symbolPhraseList=SymbolPhrase::where("symbol_id",$id)->paginate(10);
        return view("english.symbolPhraseList",["id"=>$id,"symbolPhraseList"=>$symbolPhraseList]);
    });
    Route::get("addSymbolPhrase/{id}",function ($id){
        return view("english.addSymbolPhrase",["id"=>$id]);
    });
    Route::get("editSymbolPhrase/{id}/PID/{PID}",function ($id,$PID){
        $symbolPhrase=SymbolPhrase::find($id);
        return view("english.editSymbolPhrase",["id"=>$id,"PID"=>$PID,"symbolPhrase"=>$symbolPhrase]);
    });
    //句子相关业务模块
    Route::get("symbolSentenceList/{id}",function ($id){
        $symbolSentenceList=SymbolSentence::where("symbol_id",$id)->paginate(10);
        return view("english.symbolSentenceList",["id"=>$id,"symbolSentenceList"=>$symbolSentenceList]);
    });
    Route::get("addSymbolSentence/{id}",function ($id){
        return view("english.addSymbolSentence",["id"=>$id]);
    });
    Route::get("editSymbolSentence/{id}/PID/{PID}",function ($id,$PID){
        $symbolSentence=SymbolSentence::find($id);
        return view("english.editSymbolSentence",["id"=>$id,"PID"=>$PID,"symbolSentence"=>$symbolSentence]);
    });

    //音乐相关业务
    Route::get("songsList/{id}",function ($id){
        $songsList=Song::where([
            ["ref_id","=",$id],
            ["type","=",0]
        ])->paginate(10);
        return view("english.songsList",["id"=>$id,"songsList"=>$songsList]);
    });

    Route::get("addSong/{id}",function ($id){
        return view("english.addSong",["id"=>$id]);
    });
    Route::get("editSong/{id}/PID/{PID}",function ($id,$PID){
        $song=Song::find($id);
        return view("english.editSong",["id"=>$id,"PID"=>$PID,"song"=>$song]);
    });

});
