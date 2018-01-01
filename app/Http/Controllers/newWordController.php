<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\newWord;
use Illuminate\Support\Facades\DB;
use Curl\Curl;

class newWordController extends Controller
{
    public $jinshanKey='0FA30ACFE4C4605FB4BB36218256E560';
    public  function  AddNewWord(Request $request,$id){
        date_default_timezone_set("Asia/Chongqing");
        $this->validate($request,[
            'word'=>'required'
        ]);
        $jinshanURL="http://dict-co.iciba.com/api/dictionary.php?w=".$request->input('word').
            "&key=".$this->jinshanKey."&type=json";
        $curl=new Curl();
        $curl->get($jinshanURL);
        $result=$curl->response;
        $result=json_decode($result,true);
        $word=$request->input('word');
        $yinbiao="[".$result["symbols"][0]["ph_en"]."]";
        $yinbiaoMp3=$result["symbols"][0]["ph_en_mp3"];
        $yinbiao1="[".$result["symbols"][0]["ph_am"]."]";
        $yinbiao1Mp3=$result["symbols"][0]["ph_am_mp3"];
        $chinese=$result["symbols"][0]["parts"];
        $chineseMean="";
        foreach ($chinese as $key=>$value){
            $chineseMean.=$value["part"]." ";
            foreach ($value["means"] as $words)
            {
                $chineseMean.=$words." ;";
            }
            $chineseMean=rtrim($chineseMean,";");
            $chineseMean.=PHP_EOL;
        }
        $chineseMean=rtrim($chineseMean,PHP_EOL);

        /*
        $word=$request->input('word');
        $yinbiao=$request->input('yinbiao');
        $yinbiaoMp3=$request->input('yinbiaoMp3');
        $yinbiao1=$request->input('yinbiao1');
        $yinbiao1Mp3=$request->input('yinbiaoMp3');
        $chinese=$request->input('chinese');
        */
        $created_at=date("Y-m-d H:i",time());
        $updated_at=date("Y-m-d H:i",time());
        $addResult=DB::table('new_words')->insert(
            ['word'=>$word,'chinese'=>$chineseMean,'yinbiao'=>$yinbiao,'yinbiao1'=>$yinbiao1,
                'yinbiaoMp3'=>$yinbiaoMp3,'yinbiao1Mp3'=>$yinbiao1Mp3,
                'mottoId'=>$id,'created_at'=>$created_at,'updated_at'=>$updated_at]
        );
        return redirect('/english/editNewWordList/'.$id);
    }

    public function DelNewWord($id,$mottoID){
        $result=DB::table('new_words')->where('id',$id)->delete();
        return redirect('/english/editNewWordList/'.$mottoID);
    }
    public function updateNewWord(Request $request,$id,$mottoID){
        date_default_timezone_set("Asia/Chongqing");
        $this->validate($request,[
            'word'=>'required',
            'yinbiao'=>'required',
            'chinese'=>'required'
        ]);
        $word=$request->input('word');
        $yinbiao=$request->input('yinbiao');
        $yinbiaoMp3=$request->input('yinbiaoMp3');
        $yinbiao1=$request->input('yinbiao1');
        $yinbiao1Mp3=$request->input('yinbiaoMp3');
        $chinese=$request->input('chinese');

        $updated_at=date("Y-m-d H:i",time());
        $infoResult=DB::table('new_words')->where('id',$id)->update(['word'=>$word,'chinese'=>$chinese,'yinbiao'=>$yinbiao,
            'yinbiaoMp3'=>$yinbiaoMp3,'yinbiao1'=>$yinbiao1,'yinbiao1Mp3'=>$yinbiao1Mp3,
            'updated_at'=>$updated_at]);
        return redirect('/english/editNewWordList/'.$mottoID);

    }
    public function getNewWordList($id){
        $result=DB::table('new_words')->where('mottoId',$id)->get();
        return  response()->json($result);
    }
}
