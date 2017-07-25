
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

Route::group(['middleware' => ['auth']], function () {

  // User routes
  Route::get('/app/user', 'AppController@getUser');
  Route::post('/app/settings/change', 'AppController@changeSetting');

  // Program routes
  Route::get('/app/programs/selected', 'ProgramController@getSelectedProgram');
  Route::get('/app/programs/current', 'ProgramController@getCurrentProgram');
  Route::resource('/app/programs', 'ProgramController', ['except' => [
    'edit', 'show', 'create'
  ]]);

  // Exercises routes
  Route::get('/app/exercises/categories', 'AppController@getCategories');
  Route::get('/app/exercises/search/{hint}', 'ExerciseController@searchExercise');
  Route::get('/app/exercises/category/{category}', 'ExerciseController@byCategory');
  Route::resource('app/exercises', 'ExerciseController', ['except' => [
    'edit', 'create'
  ]]);

  // Workout days
  Route::get('/app/days/today', 'DayController@getTodaysWorkout');
  Route::resource('/app/days', 'DayController', ['except' => [
    'edit', 'create'
  ]]);

  // Steps
  Route::resource('/app/steps', 'StepController');

  // Logs
  Route::post('/app/logs/today', 'StepController@getTodaysLogs');
  Route::post('/app/logs/save', 'LogController@store');
  Route::post('/app/logs/remove', 'LogController@destroy');
  Route::post('/app/logs/day', 'LogController@getDayLog');
  Route::post('/app/logs/step', 'LogController@getStepLogs');

  Route::get('/app/statistics/total', 'LogController@getStats');
  Route::post('/app/statistics/exercise', 'LogController@getExerciseHistory');


});
