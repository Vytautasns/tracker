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
    public function index(Request $request)
    {
      return $request->user()->programs;
    }


    // Get all programs for the user
    public function getSelectedProgram(Request $request)
    {
      return $request->user()->getSelectedProgram();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
      $user = Auth::user();

      $createdProgram = Program::create([
        'name' => $request->name,
        'user_id' => $user->id,
        'description' => $request->description,
        'image_url' => 'No image',
      ]);
      return $createdProgram;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \App\Program
     */
    public function show(Program $program)
    {
//      $user = Auth::user();
//      return $user->programs()->load([
//        'days' => function ($query) {
//          $query->with('steps');
//        }
//      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $program = Program::find($request->id);
      foreach ($program->days as $day) {
        $day->steps()->delete();
      }
      $program->days()->delete();
      $program->delete();
    }
}
