<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Mottos;

class mottosController extends Controller
{
    //
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

    public  function  getToday(Request $request)
    {
    }
}
