<?php
/**
 * 小程序前端端相关API接口
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/8/7
 * Ti*/
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//音标相关的业务逻辑
Route::prefix('symbol')->group(function () {

    //显示音标列表
    Route::get('symbolBaseList','symbolController@symbolBaseList');
    //显示基本信息
    Route::get('symbolBase/{id}','symbolController@getSymbolBaseByID');
    //显示基本内容
    Route::get('symbolBaseContent/{refID}','symbolController@getSymbolBaseContentByID');
    //显示常见字幕组合
    Route::get('symbolWordsGroup/{refID}','symbolController@getSymbolWordsGroupByID');
    //显示常见词语
    Route::get('symbolWords/{refID}','symbolController@getSymbolWordsByID');
    //显示相关短语
    Route::get('symbolPhrase/{refID}','symbolController@getSymbolPhrasesByID');
    //显示相关的句子
    Route::get('symbolSentence/{refID}','symbolController@getSymbolSentenceByID');
    //显示相关歌曲
    Route::get("symbolSong/{refID}",'symbolController@getSymbolSongByID');
    //显示歌曲相关详细信息
    Route::get("songInfo/{ID}",'symbolController@getsongInfoByID');
});

Route::prefix('song')->group(function(){
   Route::get("list",'SongController@allSong') ;
});

//首页展示相关业务逻辑
Route::prefix('home')->group(function (){
    Route::get("infos",'HomeController@allinfo');
    Route::get("banners",'HomeController@banners');
});

//站点新闻相关业务逻辑
Route::prefix("siteNews")->group(function(){
   Route::get("showNews/{id}","siteNewsController@showNews");
   Route::get("newsList","siteNewsController@newsList");
});