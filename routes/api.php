<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')
    ->group(function (){
        Route::post('cookStyle/list','CookStyleController@getList')->name('api.cookStyle.getList');
        Route::post('cookStyle/status','CookStyleController@status')->name('api.cookStyle.changeStatus');
    });
