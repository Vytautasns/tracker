<?php

namespace App\Http\Controllers;

use App\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // return $request->user()->exercises()->where('category_id', $request->category_id)->get();
      return Exercise::where('category_id', '=', $request->id);
    }

    // Get exercise details
    public function getExerciseDetails(Request $request)
    {
      // $a = 0;
      // while ($a <= 600000000) {
      //   # code...
      //   $a++;
      // }
      return $request->user()->exercises()->find($request->exercise_id);
    }

    // Search for exercise
    public function searchExercise($hint)
    {
      $user = Auth::user();

      $search = $user->exercises()->where('name', 'LIKE', '%' . $hint . '%')->get();
      return $search;
    }

}
