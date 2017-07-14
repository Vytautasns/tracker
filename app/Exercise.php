<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
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
   * Metods
   * *************************************************************************
  */
  public function getByCategory($categoryId)
  {
    return $this->where('category_id', $categoryId)->get();
  }
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
}
