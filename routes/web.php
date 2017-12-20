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
