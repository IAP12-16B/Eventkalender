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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::any('/', function () {
    //Route::redirect(''); // todo
    return View::make('layouts.main');
});

// frontend
Route::resource('user', 'UserController', array('only' => array('index', 'show')));
Route::resource('event', 'EventController', array('only' => array('index', 'show')));

// backend
Route::group(array('prefix' => 'admin', 'filter' => 'auth'), function () { // todo auth
    Route::resource('user', 'UserController', array('only' => array('create', 'store', 'update', 'destroy')));
    Route::resource('event', 'EventController', array('only' => array('create', 'store', 'update', 'destroy')));
});
