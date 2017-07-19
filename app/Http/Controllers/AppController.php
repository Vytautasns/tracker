<?php

namespace App\Http\Controllers;

use App\Program;
use App\Exercise;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    // Display user and settings
    public function getUser(Request $request)
    {
      return $request->user()->load('settings');
    }

    // Save setting
    public function changeSetting(Request $request)
    {
      $user = $request->user();
      $settings = $user->settings()->where('name', $request->name)->first();
      $settings->value = $request->value;
      $settings->save();
    }

    // Get all categories
    public function getCategories()
    {
      return Category::all();
    }
}
