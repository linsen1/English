<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::get('add',function (Request $request){
    $result=addInfo('Happiness is a butterfly, which ,when pursued, is always just beyond your grasp, but which, if you will sit down quietly, may alight upon you.',
        '幸福有如蝴蝶,你追逐它时永远捉不到;你静坐下来,它却可能落在你身上。',
        'https://api.hlppt.com/images/2018/001.png',
        '小时候，幸福是一件东西，拥有就幸福；长大后，幸福是一个目标，达到就幸福；成熟后，发现幸福原来是一种心态，领悟就幸福。');
    return response(json_encode($result),200)->header('Content-Type', 'application/json');
});
*/

Route::post('/add','mottosController@store');
Route::get('/new','mottosController@getToday');
Route::get('/show/{mottos}','mottosController@show');
Route::get('/getAll','mottosController@GetALL');
