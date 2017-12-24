<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Mottos;
use Illuminate\Support\Facades\DB;


class mottosController extends Controller
{
    /*
     * 添加内容
     */
    public  function store(Request $request)
    {
        $this->validate($request, [
            'chineseWord' => 'required',
            'englishWord' => 'required',
            'pic' => 'required',
            'xiaobian' => 'required'
        ]);
        date_default_timezone_set("Asia/Chongqing");
        $mottos=Mottos::create($request->all());
        return response()->json( $mottos,201);
    }
    /*
     * 显示最新
     */
    public  function  getToday(Request $request)
    {
        $newInfo=DB::select('select * from mottos ORDER by id DESC  limit 1');
        return response()->json( $newInfo,201);
    }
    /*
     * 显示对应
     */
    public function show(Mottos $mottos){
        return  $mottos;
    }
    public function GetALL()
    {
        $newList=DB::table('mottos')->orderBy('id','desc')->paginate(5);
        return response()->json($newList,201);
    }
    /*
     * 更新信息
     */
    public function updateMotto(Request $request,$id){
        $this->validate($request, [
            'chineseWord' => 'required',
            'englishWord' => 'required',
            'pic' => 'required',
            'xiaobian' => 'required'
        ]);
        $chineseWord=$request->input('chineseWord');
        $englishWord=$request->input('englishWord');
        $pic=$request->input('pic');
        $xiaobian=$request->input('xiaobian');
        $audio=$request->input('audio');
        $updateResult=DB::table('mottos')->where('id',$id)->update(['chineseWord'=>$chineseWord,'englishWord'=>$englishWord,'xiaobian'=>$xiaobian,'pic'=>$pic,'audio'=>$audio]);
        return redirect('/english/mottoList');
    }
    public function delMotto($id){
        $DelResult=DB::table('mottos')->where('id','=',$id)->delete();
        return redirect('/english/mottoList');
    }

}
