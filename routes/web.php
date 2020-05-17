<?php

use Illuminate\Support\Facades\Route;

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


//HOME


Route::get('/', ['as' => 'home', 'uses' => 'FrontController@getHome']); //controller che manda sulla home page


//ACCOUNT

Route::get('/user/auth/login', ['as' => 'user.auth.login', 
    'uses' => 'AuthController@authentication_login']); //manda a pagina di autenticazione

Route::get('/user/auth/register', ['as' => 'user.auth.register', 
    'uses' => 'AuthController@authentication_register']); //manda a pagina di autenticazione


Route::post('/user/login', ['as' => 'user.login', 
    'uses' => 'AuthController@login']);


Route::get('/user/logout', ['as' => 'user.logout', 
    'uses' => 'AuthController@logout']);


Route::post('/user/register', ['as' => 'user.register', 
    'uses' => 'AuthController@registration']);


Route::post('/user/{id}/update', ['as' => 'user.update', 
    'uses' => 'AuthController@update']);

Route::post('/user/{id}/dettagli', ['as' => 'user.dettagli', 
    'uses' => 'AuthController@dettagli']);

Route::post('/user/elenco', ['as' => 'user.elenco', 
    'uses' => 'AuthController@elenco']);

Route::post('/user/{id}/preferiti', ['as' => 'user.preferiti', 
    'uses' => 'AuthController@preferiti']);

//SENTIERI

Route::resource('sentiero', 'SentieroController'); //tutte operazioni su sentiero


Route::get('/sentiero/{id}/destroy', ['as' => 'sentiero.destroy', 
    'uses' => 'SentieroController@destroy']);


Route::get('/sentiero/{id}/destroy/confirm', ['as' => 'sentiero.destroy.confirm', 
    'uses' => 'SentieroController@confirmDestroy']);


Route::get('/sentiero/{id}/update', ['as' => 'sentiero.update', 
    'uses' => 'SentieroController@update']);

Route::post('/sentiero/ricerca', ['as' => 'sentiero.ricerca', 
    'uses' => 'SentieroController@ricerca']);



