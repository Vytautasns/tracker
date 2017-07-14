<?php

namespace App\Http\Controllers;

use App\Log;
use App\Step;
use App\Day;
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
      $log = Log::create([
        'step_id' => $request->step_id,
        'weight' => $request->weight,
        'reps' => $request->reps,
        'set' => $request->set,
        'user_id' => $request->user()->id,
        'day_id' => $request->day_id,
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
     $request->user()->logs()->find($request->id)->delete();
   }


   /**
    * Store a newly created resource in storage.
    * $request->day_id
    *
    */
    public function getDayLog(Request $request)
    {
      $logs = $request->user()->logs()->where('day_id', $request->day_id);

      if ($logs->count() > 1) {
        $workoutVolume = $logs
          ->where('created_at', '>=', \Carbon\Carbon::today()
          ->toDateString());

        $lastUpdated = $logs->latest()->select('created_at')->first();

        $daysLog = [
          'volume' => $workoutVolume->sum('weight'),
          'average' => $workoutVolume->avg('weight'),
          'last_updated' => $lastUpdated->created_at,
        ];
        return $daysLog;
      } else {
        return '';
      }


      // return $logs;

    }





}
