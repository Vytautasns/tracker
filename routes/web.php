
<?php
use App\Exercise;

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

/* App routes
********************************************************************************
*/

// Get user info
Route::post('/app/user', 'AppController@getUser');

// Save settings
Route::post('/app/settings/change', 'AppController@changeSetting');

// Program routes
Route::post('/app/programs', 'ProgramController@index');
Route::post('/app/programs/selected', 'ProgramController@getSelectedProgram');
Route::post('/app/programs/save', 'ProgramController@store');
Route::post('/app/programs/remove', 'ProgramController@destroy');


// Exercises routes
Route::get('/app/exercises/categories', 'AppController@getCategories');
Route::post('/app/exercises/show', 'ExerciseController@index');
Route::post('/app/exercises/details', 'ExerciseController@getExerciseDetails');
Route::get('/app/exercises/search/{hint}', 'ExerciseController@searchExercise');

// Workout days
Route::post('/app/days/show', 'DayController@getDayById');
Route::post('/app/days/add', 'DayController@addNewDay');
Route::post('/app/days/remove', 'DayController@removeDay');
Route::post('/app/days/update', 'DayController@update');


// Steps
Route::post('/app/steps/save', 'StepController@store');
Route::post('/app/steps/remove', 'StepController@destroy');

// Logs
Route::post('/app/logs/today', 'StepController@getTodaysLogs');
Route::post('/app/logs/save', 'LogController@store');
Route::post('/app/logs/remove', 'LogController@destroy');
Route::post('/app/logs/day', 'LogController@getDayLog');
Route::post('/app/logs/step', 'LogController@getStepLogs');

Route::get('/app/logs/stats', 'LogController@getStats');


Route::get('/app/workout/today', 'DayController@getTodaysWorkout');
