<?php
/**
 * Created by PhpStorm.
 * User: linsen
 * Date: 2017/12/26
 * Time: 下午2:53
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::post('/onLogin/{js_code}','weixinController@GetSessinID');