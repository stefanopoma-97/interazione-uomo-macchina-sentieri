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




Route::group(['middleware' => ['authCustom', 'adminCheck']], function()
    {
    Route::resource('sentiero', 'SentieroController', ['only' => ['index', 'edit', 'store', 'create', 'update']]);
        
    Route::get('/sentiero/{id}/destroy/confirm', ['as' => 'sentiero.destroy.confirm', 
        'uses' => 'SentieroController@destroy_confirm']);

    Route::get('/sentiero/{id}/destroy', ['as' => 'sentiero.destroy', 
        'uses' => 'SentieroController@destroy']);


    Route::get('/sentiero/{id}/destroy/confirm', ['as' => 'sentiero.destroy.confirm', 
        'uses' => 'SentieroController@confirmDestroy']);


    Route::get('/sentiero/{id}/update', ['as' => 'sentiero.update', 
        'uses' => 'SentieroController@update']);
    
    });

    
    
    
Route::group(['middleware' => ['authCustom']], function()
    {
    //USER

    Route::post('/user/{id}/update', ['as' => 'user.update', //sto aggiornando l'utente
        'uses' => 'UserController@update']);

    Route::get('/user/{id}/update', ['as' => 'user.edit', //vado alla pagina di editing del utente
        'uses' => 'UserController@edit']);
    
    Route::get('/user/{id}/update/password', ['as' => 'user.edit.password', //vado pagina editing password
        'uses' => 'UserController@edit_password']);
    
    Route::get('/user/{id}/update/recuperopassword', ['as' => 'user.edit.recuperopassword', //vado pagina editing password
        'uses' => 'UserController@edit_recupero_password']);
    
    Route::post('/user/{id}/update/password', ['as' => 'user.update.password', //sto aggiornando l'utente
        'uses' => 'UserController@update_password']);

    Route::get('/user/{id}/dettagli', ['as' => 'user.dettagli', 
        'uses' => 'UserController@dettagli']);

    Route::get('/user/elenco', ['as' => 'user.elenco', 
        'uses' => 'UserController@elenco']);

    Route::post('/user/{id}/preferiti', ['as' => 'user.preferiti', 
        'uses' => 'UserController@preferiti']);
    
    Route::get('/ajaxUsernameCitta', 'UserController@ajax_check_username_citta');
    
    Route::get('/ajaxNewUsername', 'UserController@ajax_check_new_username');
    
    Route::get('/ajaxCitta', 'UserController@ajax_check_citta'); 
    
    Route::post('/ajaxCheckPassword', 'UserController@ajax_check_password'); 

    Route::post('/ajaxMail', 'UserController@ajax_check_mail'); 
    
    Route::post('/ajaxCodice', 'UserController@ajax_check_codice'); 
    
    Route::post('/ajaxSendResetMail', 'UserController@ajax_send_reset_mail');

    //SENTIERI

    Route::resource('sentiero', 'SentieroController', ['only' => ['show']]); //tutte operazioni su sentiero

    Route::get('/sentiero/ricerca/sentieri', ['as' => 'sentiero.ricerca', 
        'uses' => 'SentieroController@ricerca']);

    Route::get('/sentiero/ricerca/sentieri/filtra', ['as' => 'sentiero.ricercafiltra', 
        'uses' => 'SentieroController@ricerca_filtra']);


    Route::get('/error', ['as' => 'sentiero.errore', 
        'uses' => 'SentieroController@errore']);

    Route::post('/sentiero/{id}/preferito', ['as' => 'sentiero.preferito', 
        'uses' => 'SentieroController@preferito']);


    //ESPERIENZE
    Route::get('/sentiero/{id}/nuova/esperienza', ['as' => 'esperienza.store', 
        'uses' => 'EsperienzaController@store']);
    });

