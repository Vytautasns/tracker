<?php

namespace App\Http\Controllers;

use App\Log;
use App\Step;
use App\Day;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $user = Auth::user();

      $log = Log::create([
        'step_id' => $request->step_id,
        'weight' => $request->weight,
        'reps' => $request->reps,
        'set' => $request->set,
        'user_id' => $user->id,
        'day_id' => $request->day_id,
        'program_id' => $request->program_id,
      ]);
      return $log->id;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function destroy(Request $request)
   {
     $user = Auth::user();

     $user->logs()->find($request->id)->delete();
   }


   /**
    * Store a newly created resource in storage.
    * $request->day_id
    *
    */
    public function getDayLog(Request $request)
    {
      $user = Auth::user();

      $logs = $user->logs()->where('day_id', $request->day_id)->where('created_at', '>=', \Carbon\Carbon::today()
      ->toDateString());

      if ($logs->count() >= 1) {

        $daysLog = [
          'volume' => $logs->sum('weight'),
          'average' => $logs->avg('weight'),
        ];
        return $daysLog;
      } else {
        return '';
      }


      // return $logs;

    }


    // Get all statistics
    public function getStats()
    {
      $user = Auth::user();
      return $user->getStatistics();
    }





}
