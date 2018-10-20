<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/9/8
 * Time: 下午11:23
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Song;
use App\Mottos;
use App\Article;
use App\Videos;
use App\Homebanners;

class HomeController extends  Controller
{
    public  function  allinfo(){
        $infos=array();
        $infos['mottos']=Mottos::where([
            ['id','>',0]
        ])->orderBy('id', 'desc')->take(2)->get();
        $infos['films']=Videos::where([
            ['id','>',0]
        ])->orderBy('id', 'desc')->take(3)->get();
        $infos['songs']=Song::where([
            ['id','>',0]
        ])->orderBy('id', 'desc')->take(3)->get();
        $infos['Articles']=Article::where([
            ['id','>',0]
        ])->orderBy('id', 'desc')->take(3)->get();
        //true隐藏 空显示
        $infos['showFilm']="";
        return response()->json($infos);
    }

    public  function  banners(){
        $banners=Homebanners::where([
            ['id','>',0]
        ])->orderBy('id', 'desc')->take(5)->get();
        return response()->json($banners);
    }
}