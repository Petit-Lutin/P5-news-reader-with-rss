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

Auth::routes(['verify' => true]); //vérification de l'email du nouvel utilisateur
//Route::get('protege', function () {
//    return 'affichage de la route protégé';
//})->middleware('verified');

Route::get('/home', 'HomeController@index')->name('home');

//Flux
Route::get('/index', 'FlowController@index')->name('index')->middleware('verified');
Route::get('/flows/create', 'FlowController@create');
Route::post('/flows/create', 'FlowController@store');
Route::get('/flows/show/{id}', 'FlowController@show');
Route::get('/flows/edit/{id}', 'FlowController@edit');
Route::post('/flows/edit/{id}', 'FlowController@update');
Route::get('/flows/delete/{id}', 'FlowController@destroy');


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

