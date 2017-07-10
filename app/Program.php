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

  // To user Relationships
  public function users()
  {
    return $this->belongsToMany(User::class);
  }

  // All days for the program Relationship
  public function days()
  {
    return $this->hasMany(Day::class);
  }
  
}
