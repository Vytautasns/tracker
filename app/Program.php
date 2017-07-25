<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Program extends Model
{
  /**
   * The attributes that are not mass assignable.
   *
   * @var array
   */
  protected $guarded = [

  ];

  /*
   *
   * Methods
   * *************************************************************************
  */

  public function todaysWorkout()
  {
    $today = Carbon::today()->format('l');
    return $this->days()
      ->with(['steps' => function ($query) {
        $query->join('exercises', 'steps.exercise_id', 'exercises.id')
        ->select('steps.*', 'exercises.name', 'exercises.image_url');
      }])
      ->where('week_days', 'LIKE', '%' . substr($today, 0, 2) . '%')
      ->get();
  }

  /*
   *
   * Relationships
   * *************************************************************************
  */

  // Get user for this program
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // Get training days for this program
  public function days()
  {
    return $this->hasMany(Day::class);
  }

  // Get logs
  public function logs()
  {
    return $this->hasMany(Log::class);
  }

}
