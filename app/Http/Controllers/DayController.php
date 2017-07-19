<?php

namespace App\Http\Controllers;

use App\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayController extends Controller
{
  // Get program day by its id
  public function getDayById(Request $request)
  {
    $user = $request->user();
    return $user->getSelectedProgram()->days()->find($request->day_id)->getSteps();
  }

  // Save new day to program
  public function addNewDay(Request $request)
  {
    $newDay = Day::create([
      'program_id' => $request->program_id,
      'name' => $request->name,
      'week_days' => implode(',', $request->week_days),
    ]);

    return $newDay;
  }

  // delete day
  public function removeDay(Request $request)
  {
    $day = Day::find($request->id);
    foreach ($day->steps as $step) {
      $step->logs()->delete();
    }
    $day->steps()->delete();
    $day->delete();
  }

  // Update day
  public function update(Request $request)
  {
    $day = Day::find($request->id);
    $day->name = $request->name;
    $day->week_days = $request->week_days;
    $day->save();
  }

  // Get todays workout
  public function getTodaysWorkout()
  {
    $user = Auth::user();
    return $user->getTodaysWorkout();
  }
}
