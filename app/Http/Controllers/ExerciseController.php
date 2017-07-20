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
      $user = $request->user();
      return $user->exercises()->where('category_id', $request->category_id)->get();
    }

    // Get exercise details
    public function getExerciseDetails(Request $request)
    {
      // $a = 0;
      // while ($a <= 600000000) {
      //   # code...
      //   $a++;
      // }

      $user = $request->user();
      return $user->exercises()->find($request->exercise_id);
    }

    // Search for exercise
    public function searchExercise($hint)
    {
      $user = Auth::user();

      $search = $user->exercises()->where('name', 'LIKE', '%' . $hint . '%')->get();
      return $search;
    }

    // Store new exercise
    public function store(Request $request)
    {

      $this->validate($request, [
        'name' => 'required|min:3|max:255',
        'category_id' => 'required|integer',
      ]);

      $user = $request->user();

      if ($request->id) {
        $exercise = Exercise::find($request->id);

        if ($exercise->default != 1) {
          $exercise->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
          ]);
        }

      } else {
        $exercise = Exercise::create([
          'name' => $request->name,
          'category_id' => $request->category_id,
          'description' => $request->description,
          'image_url' => 'no_image',
          'default' => 0,
        ]);
        $user->exercises()->attach($exercise->id);

      }

      return $exercise->id;

    }

    // Delete exercise
    public function destroy(Request $request)
    {
      $this->validate($request, [
        'id' => 'integer',
      ]);

      $user = $request->user();

      $user->exercises()->detach($request->id);
    }

}
