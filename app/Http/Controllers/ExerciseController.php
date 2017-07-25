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
    public function index()
    {
      $user = Auth::user();
      return $user->exercises;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($exercise)
    {
      $user = Auth::user();
      $result = $user->exercises()->find($exercise);
      if (!$result) {
        return response('Exercise not found', 404);
      }
      return $result;
    }


    // Store new exercise
    public function store(Request $request)
    {

      $this->validate($request, [
        'name' => 'required|min:3|max:255',
        'category_id' => 'required|integer',
      ]);

      $user = $request->user();

      $exercise = Exercise::create([
        'name' => $request->name,
        'category_id' => $request->category_id,
        'description' => $request->description,
        'image_url' => 'no_image',
        'default' => 0,
      ]);

      $user->exercises()->attach($exercise->id);

      return $exercise->id;
    }


    // Update exercise
    public function update(Request $request, Exercise $exercise)
    {
      $this->validate($request, [
        'name' => 'required|min:3|max:255',
        'category_id' => 'required|integer',
      ]);

      $user = $request->user();

      if ($exercise->users()->where('user_id', $user->id)->get()->count() != 1) {
        return response('Unauthorized', 401);
      }

      $exercise->update([
        'name' => $request->name,
        'category_id' => $request->category_id,
        'description' => $request->description,
      ]);

      return $exercise->id;
    }


    // Delete exercise
    public function destroy($exercise)
    {
      $user = Auth::user();
      $user->exercises()->detach($exercise);
    }


    // Get exercises for the category
    public function byCategory($category)
    {
      $user = Auth::user();
      return $user->exercises()->where('category_id', $category)->get();
    }


    // Search for exercise
    public function searchExercise($hint)
    {
      $user = Auth::user();

      $search = $user->exercises()->where('name', 'LIKE', '%' . $hint . '%')->get();
      return $search;
    }
}
