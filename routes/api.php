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
Route::put('/english/edit/{id}','mottosController@updateMotto');
Route::delete('/english/del/{id}','mottosController@delMotto');
Route::get('/new','mottosController@getToday');
Route::get('/show/{mottos}','mottosController@show');
Route::get('/getAll','mottosController@GetALL');
/*
 * 单词管理相关业务逻辑
 */
Route::post('/english/addNewWord/{id}/{no}','newWordController@AddNewWord');
Route::delete('/english/delWord/{id}/mottoID/{mottoID}/type/{type}','newWordController@DelNewWord');
Route::put('/english/editNewWord/{id}/mottoID/{mottoID}/type/{type}','newWordController@updateNewWord');
Route::get('/english/getword/{id}','newWordController@getNewWordList');
Route::get('/english/getVideoWord/{id}','newWordController@getVideoWordList');

/*
 * 用户信息管理相关业务
 */
Route::post('/english/addUser','EUsersController@AddUsers');
Route::post('/english/addMyMotto','MyMottosController@AddUserMotto');
Route::post('/english/checkMyMotto/','MyMottosController@checkMyMotto');
Route::post('/english/DelMyMotto/','MyMottosController@DelMyMotto');
Route::post('/english/GetMyMottoList','MyMottosController@GetMyMottoList');
Route::post('/english/AddMyWords','MyWordsController@AddMyWords');
Route::post('/english/CheckIfMyWords','MyWordsController@CheckIfMyWords');

/*
 * 添加视频逻辑
 */
Route::post('/english/addNewVideo','VideosController@addNewVideos');
Route::get('/english/newVideo','VideosController@getNewVideo');
Route::get('/english/getVideoList','VideosController@getVideoList');
Route::put("/english/updateVideo/{id}",'VideosController@updateVideo');
Route::delete('/english/delVideo/{id}','VideosController@delVideo');
Route::get('/english/showVideo/{Video}','VideosController@showVideo');
/*
 * 添加美文相关逻辑
 */
Route::post('/english/addNewArticle','ArticleControllers@addNewArticle');
Route::get('/english/NewArticle','ArticleControllers@getNewArticle');
Route::get('/english/getArticleList','ArticleControllers@getArticleList');
Route::get('/english/showArticle/{Article}','ArticleControllers@showArticle');
Route::put('/english/editArticleInfo/{id}','ArticleControllers@updateArticle');
Route::delete('/english/delArticle/{id}','ArticleControllers@delArticle');
Route::get('/english/getArticleWord/{id}','newWordController@getArticleWordList');
