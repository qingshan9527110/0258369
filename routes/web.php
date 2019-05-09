<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * 前端页面
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * 后台页面
 */
Route::prefix('back')
    ->namespace('Back')
    ->group(function (){
        Route::get('/','IndexController@index')->name('back.index.index');
        Route::get('welcome','IndexController@welcome')->name('back.index.welcome');
        Route::get('info','IndexController@info')->name('back.index.info');

        //登陆注册
        Route::get('admin/login', 'LoginController@showLoginForm')->name('back.admin.login');
        Route::post('admin/login', 'LoginController@login');
        Route::get('admin/register', 'RegisterController@showRegistrationForm')->name('back.admin.register');
        Route::post('admin/register', 'RegisterController@register');
        Route::post('admin/logout', 'LoginController@logout')->name('back.admin.logout');
        Route::get('admin', 'AdminController@index')->name('back.admin.index');
        Route::get('admin/del', 'AdminController@del')->name('back.admin.del');


        Route::get('users','UsersController@index')->name('back.users.index');
        Route::get('users/del','UsersController@del')->name('back.users.del');

        Route::get('cookStyle/index','CookStyleController@index')->name('back.cookStyle.index');
        Route::post('cookStyle/getList','CookStyleController@getList')->name('back.cookStyle.getList');
        Route::get('cookStyle/{pid?}','CookStyleController@create')->name('back.cookStyle.create');
        Route::post('cookStyle','CookStyleController@store')->name('back.cookStyle.store');
        Route::get('cookStyle/{id}/edit','CookStyleController@edit')->name('back.cookStyle.edit');
        Route::put('cookStyle/{id}','CookStyleController@update')->name('back.cookStyle.update');
        Route::delete('cookStyle','CookStyleController@destroy')->name('back.cookStyle.desc');

        Route::resource('category', 'CategoryController');
});


Route::get('/home', 'HomeController@index')->name('home');
