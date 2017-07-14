<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
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
   * Method
   * *************************************************************************
  */
  public function getSteps()
  {
    return $this->load([
      'steps' => function ($query) {
        $query->join('exercises', 'steps.exercise_id', 'exercises.id')
        ->select('steps.*', 'exercises.name', 'exercises.image_url');
      }
    ]);
  }

  /*
   *
   * Relationships
   * *************************************************************************
  */

  // Program where this day belongTo
  public function program()
  {
    return $this->belongsTo(Program::class);
  }

  // All steps for this day
  public function steps()
  {
    return $this->hasMany(Step::class);
  }
}
