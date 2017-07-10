<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\File;
use App\Program;
use App\Day;
use App\Step;

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
    public function createDefaultPrograms()
    {
       $path = database_path();
       $json = File::get("$path/data/program.json");
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
