<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /*
     *
     * Relationships
     * *************************************************************************
    */

    // User settings
    public function settings()
    {
      return $this->hasMany(Setting::class);
    }

    // Programs Relationship
    public function programs()
    {
      return $this->belongsToMany(Program::class);
    }

    // Exercises Relationship
    public function exercises()
    {
      return $this->belongsToMany(Exercise::class);
    }

}
