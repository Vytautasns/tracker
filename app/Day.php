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

  // Relationship with Program
  public function program()
  {
    return $this->belongsTo(Program::class);
  }
}
