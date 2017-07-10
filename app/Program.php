<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


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

}
