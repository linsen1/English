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