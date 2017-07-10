<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Setting;
use App\Program;
use App\Exercise;

class LogRegisteredUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {

      $user = $event->user;

      // Create initial settings
      // for newly registered user
      $user->createDefaultSettings();

      // Attach all default exercises to a user
      // from exercises table
      // /database/data/exercises_seed.json
      $user->attachDefaultExercises();

      // Create default starting programs
      // from file /database/data/programs.json
      $user->createDefaultPrograms();

    }
}
