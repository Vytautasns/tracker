<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
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

  // Day where step (Exercise) belongs
  public function day()
  {
    return $this->belongsTo(Day::class);
  }


  // All logs for this step
  public function logs()
  {
    return $this->hasMany(Log::class);
  }
}
