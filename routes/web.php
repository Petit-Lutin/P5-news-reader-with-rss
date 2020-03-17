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
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Auth::routes(['verify' => true]); //vérification de l'email du nouvel utilisateur

//Utilisateur
Route::get('/user/edit/{id}', 'UserController@edit')->name('user/edit/')->middleware('verified');


//Flux
Route::get('/index', 'FlowController@index')->name('index')->middleware('verified');
Route::get('/flows/create', 'FlowController@create')->middleware('verified');
Route::post('/flows/create', 'FlowController@store')->middleware('verified');
Route::get('/flows/show/{id}', 'FlowController@show')->middleware('verified');
Route::get('/flows/edit/{id}', 'FlowController@edit')->middleware('verified');
Route::post('/flows/edit/{id}', 'FlowController@update')->middleware('verified');
Route::get('/flows/delete/{id}', 'FlowController@destroy')->middleware('verified');


//Catégories de flux
Route::get('/categories/create', 'CategoryController@create');
Route::post('/categories/create', 'CategoryController@store');
Route::get('/categories/edit/{id}', 'CategoryController@edit');
Route::post('/categories/edit/{id}', 'CategoryController@update');
Route::get('/categories/delete/{id}', 'CategoryController@destroy');

Route::get('/getjson/{id}', 'RssController@getJson');

//Footer
Route::get('/mentions-legales', 'HomeController@mentionslegales');
Route::get('/politique-confidentialite', 'HomeController@politiqueconfidentialite');

