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