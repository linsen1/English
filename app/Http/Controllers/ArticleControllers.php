<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/1/28
 * Time: 下午7:52
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
USE App\Article;
use Illuminate\Support\Facades\DB;
use Curl\Curl;

class ArticleControllers extends Controller
{
    public function  addNewArticle(Request $request){
        date_default_timezone_set("Asia/Chongqing");
        $this->validate($request,[
            'title'=>'required',
            'note'=>'required',
            'mp3URL'=>'required',
            'englishContent'=>'required',
            'chineseContent'=>'required',
            'picUrl'=>'required'
        ]);
        $title=$request->input('title');
        $note=$request->input('note');
        $picUrl=$request->input('picUrl');
        $mp3URL=$request->input('mp3URL');
        $englishContent=$request->input('englishContent');
        $chineseContent=$request->input('chineseContent');
        $result=DB::table('articles')->insert(
            [
                'title'=>$title,
                'note'=>$note,
                'picUrl'=>$picUrl,
                'mp3URL'=>$mp3URL,
                'englishContent'=>$englishContent,
                'chineseContent'=>$chineseContent,
                'created_at'=>date("Y-m-d H:i",time()),
                'updated_at'=>date("Y-m-d H:i",time())
            ]
        );
        if($result){
            return redirect('/english/articleList');
        }
        else
        {
            return response()->json($result);
        }
    }
    public function updateArticle(Request $request,$id){
        date_default_timezone_set("Asia/Chongqing");
        $this->validate($request,[
            'title'=>'required',
            'note'=>'required',
            'picUrl'=>'required',
            'mp3URL'=>'required',
            'englishContent'=>'required',
            'chineseContent'=>'required',
            'created_at'=>date("Y-m-d H:i",time()),
            'updated_at'=>date("Y-m-d H:i",time())
        ]);
        $title=$request->input('title');
        $note=$request->input('note');
        $picUrl=$request->input('picUrl');
        $mp3URL=$request->input('mp3URL');
        $englishContent=$request->input('englishContent');
        $chineseContent=$request->input('chineseContent');
        $updateResult=DB::table('articles')->where('id',$id)->
            update([
            'title'=>$title,
            'note'=>$note,
            'picUrl'=>$picUrl,
            'mp3URL'=>$mp3URL,
            'englishContent'=>$englishContent,
            'chineseContent'=>$chineseContent,
            'updated_at'=>date("Y-m-d H:i",time())
                ]);
        if($updateResult==0||$updateResult==1){
            return redirect('/english/articleList');
        }else{
            return response()->json($updateResult);
        }
    }
    public function delArticle($id){
        $DelResult=DB::table('articles')->where('id','=',$id)->delete();
        if($DelResult==1){
            return redirect('/english/articleList');
        }
        else
        {
            return response()->json($DelResult);
        }
    }
    public function getNewArticle(){
        $newArticle=DB::select('select * from articles ORDER by id DESC  limit 1');
        return response()->json( $newArticle,200);
    }
    public function getArticleList(){
        $videoList=DB::table('articles')->orderBy('id','desc')->paginate(5);
        return response()->json($videoList,201);
    }
    public function showArticle(Article $Article){
        return $Article;
    }
}