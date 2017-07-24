<?php

namespace App\Http\Controllers;

use App\Program;
use App\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      return $user->availablePrograms();
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
        'name' => 'required|min:3|max:255',
        'description' => 'required|min:3',
      ]);

      $user = $request->user();

      $program = Program::create([
        'name' => $request->name,
        'user_id' => $user->id,
        'description' => $request->description,
        'image_url' => 'custom',
      ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
      $this->validate($request, [
        'name' => 'required|min:3|max:255',
        'description' => 'required',
      ]);

      $user = $request->user();

      if ($program->user_id != $user->id) {
        return response('Unauthorized', 401);
      }

      $program->update([
        'name' => $request->name,
        'description' => $request->description,
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
      // $a = 0;
      // while ($a <= 600000000) {
      //   $a++;
      // }
      $user = Auth::user();

      if ($program->user_id != $user->id) {
        return response('Unauthorized', 401);
      }

      foreach ($program->days as $day) {
        $day->steps()->delete();
      }
      $program->days()->delete();
      $program->delete();
    }


    // Get all programs for the user
    public function getSelectedProgram()
    {
      $user = Auth::user();
      return $user->selectedProgram();
    }

}
