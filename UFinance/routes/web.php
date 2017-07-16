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

// Route::get('/', function () {
//     return view('welcome');
// });

// 交易紀錄
Route::get('/transaction','FinanceController@showTransaction');
Route::post('/addTransaction','FinanceController@create');

// 交易類型
Route::get('/type','AccountTypeController@show');
Route::post('/addAccountType','AccountTypeController@create');
Route::get('/getTypes','AccountTypeController@getTypes');
Route::delete('/deleteTransaction','FinanceController@deleteTransaction');
Route::put('/update','FinanceController@update');

// 統計
Route::get('/statistics','StatisticsController@show');
Route::get('/getAllData','StatisticsController@getAllData');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/','HomeController@index');