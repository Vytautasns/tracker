<?php

namespace App\Http\Controllers;

use App\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StepController extends Controller
{

    // Get todays log for step
    // Step id - request->id
    public function getTodaysLogs(Request $request)
    {
      $user = $request->user();
      return
      $user->logs()
      ->where('step_id', $request->id)
      ->where('created_at', '>=', \Carbon\Carbon::today()
      ->toDateString())
      ->orderBy('created_at', 'desc')
      ->get();

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $step = Step::create([
          'exercise_id' => $request->exercise_id,
          'day_id' => $request->day_id,
          'reps' => $request->reps,
          'sets' => $request->sets,
        ]);
        return $step->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function show(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Step $step)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function destroy(Step $step)
    {
      $step->logs()->delete();
      $step->delete();
    }
}
