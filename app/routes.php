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

//Main
Route::get('/', 'Home@main');

//Adding
Route::get('/add/', 'Add@add');
Route::post('/insert/', 'Add@insert');

//Searching
Route::get('/search/', 'Home@main');
Route::post('/find/', 'Search@find');
Route::post('/results/', 'Search@results');

//Data Dump
/*
Route::post('/dump/data/'. function() {
	return View::make('data', ['data', $_POST]);
});
*/

/*
Route::get('/add/', function()
{
    return View::make('addB');
});
*/

/*
Route::get('/modef', function(){
    return View::make('main');
});
*/
