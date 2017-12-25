<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\newWord;
use Illuminate\Support\Facades\DB;
class newWordController extends Controller
{
    public  function  AddNewWord(Request $request,$id){
        date_default_timezone_set("Asia/Chongqing");
        $this->validate($request,[
            'word'=>'required',
            'yinbiao'=>'required',
            'chinese'=>'required'
        ]);
        $word=$request->input('word');
        $yinbiao=$request->input('yinbiao');
        $chinese=$request->input('chinese');
        $created_at=date("Y-m-d H:i",time());
        $updated_at=date("Y-m-d H:i",time());
        $addResult=DB::table('new_words')->insert(
            ['word'=>$word,'chinese'=>$chinese,'yinbiao'=>$yinbiao,'mottoId'=>$id,'created_at'=>$created_at,'updated_at'=>$updated_at]
        );
        return redirect('/english/editNewWordList/'.$id);
    }

    public function DelNewWord($id,$mottoID){
        $result=DB::table('new_words')->where('id',$id)->delete();
        return redirect('/english/editNewWordList/'.$mottoID);
    }
}
