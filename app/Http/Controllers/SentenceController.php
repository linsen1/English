<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2018/4/29
 * Time: 上午1:11
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Sentences;
use App\baiduHelper\AipSpeech ;
use App\baiduHelper\Translate;
use Illuminate\Support\Facades\DB;
use App\aliHelper\aliOss;

class SentenceController extends Controller
{
    //添加短语
    public  function  addSentence(Request $request,$refID,$type){
        $EnWords=$request->input('EnWords');
        $result=array();
        if($this->checkSentence($EnWords)){
            // 翻译短语
            $translateServer=new Translate();
            $result=$translateServer->translate($EnWords,'en','zh');
            //生成和成语音文件
            $speech_APP_ID =config('vcode.baiduSpeech.speech_APP_ID');
            $speech_API_KEY = config('vcode.baiduSpeech.speech_API_KEY');
            $speech_SECRET_KEY =config('vcode.baiduSpeech.speech_SECRET_KEY ');
            $client = new AipSpeech($speech_APP_ID, $speech_API_KEY , $speech_SECRET_KEY);
            $results = $client->synthesis($EnWords, 'zh', 1, array(
                'vol' => 5,
            ));
            // 识别正确返回语音二进制 错误则返回json 参照下面错误码
            if(!is_array($results)){
                $CnWords=$result['trans_result'][0]['dst'];
                $id = DB::table('sentences')->insertGetId(
                    [
                        'EnWords' => $EnWords,
                        'CnWords' => $CnWords,
                        'type'=>$type,
                        'refID'=>$refID,
                        'created_at'=> date("Y-m-d H:i:s", time()),
                        'updated_at'=> date("Y-m-d H:i:s", time())
                    ]
                );
                //将声音文件上传至阿里存储空间
                $aliossService=new aliOss();
                $bucket=config('vcode.alifile.bucket');
                $PathDate='sentences/'.date("Y-m", time()).'/';
                $savePath=$PathDate.$id.'.mp3';
                $savaUrl=config('vcode.alifile.filesite').$savePath;
                DB::table('sentences')->where('id', $id)->update(['EnMp3' => $savaUrl]);
                if($aliossService->uploadByString($results,$savePath,$bucket)){

                }else{

                }
            }

            return redirect('/english/editSentenceList/'.$refID.'/type/'.$type);
            //return  $result['trans_result'][0]['dst'];
            }
            else{
            $result=array(
                'result'=>'this sentences was added'
            );
            return response()->json($result);
        }
    }
    //判断是否添加
    public  function  checkSentence($words){
        $count=DB::table('sentences')->where('EnWords',$words)->count();
        if($count>0){
            return  false;
        }else{
            return true;
        }
    }
    //更新短语
    public function updateSentence(Request $request,$id,$refID,$type){
        date_default_timezone_set("Asia/Chongqing");
        $this->validate($request,[
            'EnWords'=>'required',
            'CnWords'=>'required',
            'EnMp3'=>'required'
        ]);
        $EnWords=$request->input('EnWords');
        $CnWords=$request->input('CnWords');
        $EnMp3=$request->input('EnMp3');
        $updated_at=date("Y-m-d H:i:s",time());
        $infoResult=DB::table('sentences')->where('id',$id)->update(
            [
                'EnWords'=>$EnWords,
                'CnWords'=>$CnWords,
                'EnMp3'=>$EnMp3,
                'updated_at'=>$updated_at]);
        if($infoResult==1)
        {
            return redirect('/english/editSentenceList/'.$refID.'/type/'.$type);
        }
        else {
            return response()->json($infoResult);
        }


    }
    //删除短语
    public function delSentence($id,$refID,$type){
        $result=DB::table('sentences')->where('id',$id)->delete();
        if ($result==1){
            return redirect('/english/editSentenceList/'.$refID.'/type/'.$type);

        }else{
            return response()->json($result);
        }
    }
    //获取短语
    public function getSentenceByID($refID,$type){
        $result=DB::table('sentences')->where(['refID'=>$refID,'type'=>$type])->get();
        return  response()->json($result);
    }
}