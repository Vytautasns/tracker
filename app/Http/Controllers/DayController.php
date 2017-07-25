<?php

namespace App\Http\Controllers;

use App\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $user = Auth::user();
      return $user->currentProgram()->days;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
        'name' => 'required|min:3',
    ]);


    $newDay = Day::create([
      'program_id' => $request->program_id,
      'name' => $request->name,
      'week_days' => implode(',', $request->week_days),
    ]);

    return $newDay;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $user = Auth::user();
      $day = $user->currentProgram()->days()->find($id);
      if (!$day) {
        return response('Step not found', 404);
      }
      return $day->getSteps();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Day $day)
  {
    $this->validate($request, [
        'name' => 'required|min:3',
    ]);

    $day->update([
      'name' => $request->name,
      'week_days' => implode(',', $request->week_days),
    ]);

    return $day;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Day $day)
  {
    foreach ($day->steps as $step) {
      $step->logs()->delete();
    }
    $day->steps()->delete();
    $day->delete();

  }

  /**
   * Get todays workouts
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function getTodaysWorkout()
  {
    $user = Auth::user();
    return $user->currentProgram()->todaysWorkout();
  }


}
