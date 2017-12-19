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
            'xiaobian' => 'required',
        ]);
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
        $newList=DB::table('mottos')->paginate(1);
        return response()->json($newList,201);
    }


}
