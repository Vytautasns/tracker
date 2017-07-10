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

}
