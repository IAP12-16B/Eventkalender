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
Route::any('/', array(
    'as' => 'home',
    function () {
        return Redirect::route('show.index');
    }
));


// frontend
Route::get('show/archive', array('uses' => 'ShowController@archive', 'as' => 'show.archive'));
Route::resource('show', 'ShowController', array('only' => array('index', 'show')));


// login / logout
Route::get('login', array('uses' => 'LoginController@showLogin', 'as' => 'login', 'before' => 'guest'));
Route::post('login', array('uses' => 'LoginController@doLogin', 'as' => 'doLogin', 'before' => 'csrf'));
Route::get('logout', array('uses' => 'LoginController@doLogout', 'as' => 'logout', 'before' => 'auth'));

// backend
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function () {
    Route::any('/', array(
        'as' => 'home',
        function () {
            return Redirect::route('admin.event.index');
        }
    ));
    //Route::resource('user', 'UserController', array('only' => array('index', 'create', 'store', 'update', 'destroy')));
    Route::resource('event', 'EventController',
        array('only' => array('index', 'create', 'store', 'update', 'destroy', 'edit')));

    Route::resource('genre', 'GenreController', array('only' => array('edit', 'index', 'update', 'store', 'destroy')));
    Route::resource('pricegroup', 'PricegroupController', array('only' => array('edit', 'index', 'update', 'store', 'destroy')));
});


require app_path() . '/menu.php';