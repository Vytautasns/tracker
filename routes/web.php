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


Auth::routes();

Route::get('/', 'PageController@index');
Route::get('/{any}', 'PageController@index');

// Route::get('/api/exercises', 'ProgramController@index');
// Route::post('/api/change', 'ProgramController@store');
//
// Route::get('/api/get/{id}', 'ProgramController@getByCat');
//
//
// Route::get('/api/programs/available', 'ProgramController@getAvailablePrograms');


/* App routes
********************************************************************************
*/

// Get user info
Route::get('app/user', 'AppController@getUser');

// Save settings
Route::post('app/user', 'AppController@saveSetting');


// Program routes
Route::resource('app/programs', 'ProgramController');
