<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  /* The attributes that are not mass assignable.
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
 public function exercises()
 {
   return $this->hasMany(Exercise::class);
 }

}
