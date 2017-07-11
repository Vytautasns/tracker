<?php

namespace App\Http\Controllers;

use App\Program;
use App\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    // Display user and settings
    public function getUser()
    {
      $user = Auth::user();
      return $user->load('settings');
    }

    // Save setting
    public function saveSetting(Request $request)
    {
      dd($request->user);
    }
}
