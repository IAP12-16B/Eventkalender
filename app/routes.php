<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Home
Route::any('/', function () {
    return View::make('layouts.main'); // todo
});

// frontend
//Route::resource('user', 'UserController', array('only' => array('index', 'show')));
/*Route::get('event/archive', array('uses' => 'EventController@archive', 'as' => 'event.archive'));
Route::resource('event', 'EventController', array('only' => array('index', 'show'))); // todo check if these routes are used
*/

Route::get('show/archive', array('uses' => 'ShowController@archive', 'as' => 'show.archive'));
Route::resource('show', 'ShowController', array('only' => array('index', 'show')));


// login / logout
Route::get('login', array('uses' => 'LoginController@showLogin', 'as' => 'login', 'before' => 'guest'));
Route::post('login', array('uses' => 'LoginController@doLogin', 'as' => 'doLogin', 'before' => 'csrf'));
Route::get('logout', array('uses' => 'LoginController@doLogout', 'as' => 'logout', 'before' => 'auth'));

// backend
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function () {
    Route::resource('user', 'UserController', array('only' => array('create', 'store', 'update', 'destroy')));
    Route::resource('event', 'EventController', array('only' => array('create', 'store', 'update', 'destroy')));
});


require app_path().'/menu.php';