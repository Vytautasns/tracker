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
