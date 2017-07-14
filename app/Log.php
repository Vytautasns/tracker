<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
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

  // Step for this log entry
  public function step()
  {
    return $this->belongsTo(Step::class);
  }
}
