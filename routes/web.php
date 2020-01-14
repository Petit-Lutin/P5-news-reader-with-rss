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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Flux
Route::get('/index', 'FlowController@index')->name('index');

Route::get('/flows/create', 'FlowController@create');
Route::post('/flows/create', 'FlowController@store');

Route::get('/flows/show/{id}', 'FlowController@show');

Route::get('/flows/edit/{id}', 'FlowController@edit');
Route::post('/flows/edit/{id}', 'FlowController@update');



//Catégories de flux
Route::get('/categories/create', 'CategoryController@create');
Route::post('/categories/create', 'CategoryController@store');

Route::get('/categories/edit/{id}', 'CategoryController@edit');
Route::post('/categories/edit/{id}', 'CategoryController@update');

Route::get('/getjson/{id}', 'TestRssController@getJson');

Route::get('/test', 'TestController@index');
Route::get('/testrss', 'TestController@index');
