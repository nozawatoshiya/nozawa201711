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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login','AuthController@login')->name('login');
Route::post('/login','AuthController@storeLogin')->name('login');

Route::group(['middleware'=>['AuthCheck']],function(){
  Route::post('/logout','AuthController@Logout')->name('logout');
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/attend/','AttendController@index')->name('AttendArchive');
  Route::post('/attend/','AttendController@postindex')->name('AttendArchive');
  Route::get('/attend/create','AttendController@create')->name('AttendCreate');
  Route::post('/attend/create','AttendController@store')->name('AttendCreate');
  Route::get('/attend/{id}','AttendController@show')->name('AttendArchive');
  Route::group(['middleware'=>['EditCheck']],function(){
    Route::get('/attend/{id}/edit','AttendController@edit')->name('AttendEdit');
    Route::post('/attend/{id}/edit','AttendController@update')->name('AttendEdit');
    Route::post('/attend/{id}/delete','AttendController@destroy')->name('AttendDstroy');
    Route::get('/admin','AdminController@index')->name('admin');
  });
});
