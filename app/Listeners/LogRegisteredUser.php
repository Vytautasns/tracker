<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Setting;
use App\Program;

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

      Setting::create([
       'user_id' => $user->id,
       'name' => 'first_login',
       'value' => '1',
      ]);

      Setting::create([
        'user_id' => $user->id,
        'name' => 'weight_units',
        'value' => 'kg',
      ]);


      $user->createDefaultPrograms();

    }
}
