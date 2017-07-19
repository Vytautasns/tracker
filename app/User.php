<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\File;
use App\Program;
use App\Day;
use App\Step;
use App\Exercise;
use App\Setting;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /*
     *
     * Methods
     * *************************************************************************
    */

    // Attach all default exercises to a user
    // from exercises table
    // /database/data/exercises_seed.json
    public function attachDefaultExercises()
    {
      $exercises = \App\Exercise::all();
      foreach ($exercises as $exercise) {
        $this->exercises()->attach($exercise->id);
      }
    }

    // Create initial settings
    // for newly registered user
    public function createDefaultSettings()
    {
      Setting::create([
       'user_id' => $this->id,
       'name' => 'first_login',
       'value' => '1',
      ]);

      Setting::create([
        'user_id' => $this->id,
        'name' => 'weight_units',
        'value' => 'kg',
      ]);
    }

    // Create default starting programs
    // from file /database/data/programs.json
    public function createDefaultPrograms()
    {
       $path = database_path();
       $json = File::get("$path/data/programs.json");
       $data = json_decode($json);

       foreach ($data as $program) {
         $newProgram = Program::create([
               'name' => $program->name,
               'image_url' => $program->image_url,
               'description' => $program->description,
               'user_id' => $this->id,
           ]);

           foreach ($program->days as $day) {

             $newDay = Day::create([
               'name' => $day->name,
               'week_days' =>$day->week_days,
               'program_id' => $newProgram->id,
             ]);

             foreach ($day->steps as $step) {
               $newStep = Step::create([
                 'exercise_id' => $step->exercise_id,
                 'day_id' => $newDay->id,
                 'reps' => $step->reps,
                 'sets' => $step->sets,
               ]);
             }

           }
       }

       // TODO let user choose program upon first start
       // Temp take first created program
       Setting::create([
         'user_id' => $this->id,
         'name' => 'selected_program',
         'value' => $this->programs()->first()->id,
       ]);

    }



    // Return selected program
    public function getSelectedProgram()
    {
      $selected = $this->settings()
                        ->where('name', 'selected_program')
                        ->pluck('value')->first();

      return $this->programs()->find($selected)->load([
        'days' => function ($query) {
          $query->with('steps');
        }
      ]);
    }


    // Return all logs
    public function getStatistics()
    {
      $selected = $this->settings()
                        ->where('name', 'selected_program')
                        ->pluck('value')->first();


      $weekLog = $this->programs()->find($selected)->logs()->get()
      ->groupBy(function($item){ return $item->created_at->format('d-M'); });

      return $weekLog;

    }


    // Get todays workout
    public function getTodaysWorkout()
    {

    }


    /*
     *
     * Relationships
     * *************************************************************************
    */

    // User settings
    public function settings()
    {
      return $this->hasMany(Setting::class);
    }

    // All users programs
    public function programs()
    {
      return $this->hasMany(Program::class);
    }

    // Exercises Relationship
    public function exercises()
    {
      return $this->belongsToMany(Exercise::class);
    }

    // All user weight logs
    public function logs()
    {
      return $this->hasMany(Log::class);
    }

}
