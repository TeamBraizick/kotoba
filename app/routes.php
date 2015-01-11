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

Route::get('/', 'Home@main');
Route::get('/add/', 'Home@add');
Route::get('/search/', 'Home@search');
Route::post('/insert/', 'Home@insert');
Route::post('/find/', 'Home@find');
Route::post('/search/results', 'Search@results');



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
