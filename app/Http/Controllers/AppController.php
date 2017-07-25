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
    public function getUser()
    {
      $user = Auth::user();

      // Check if there is a user
      if (!$user) {
        return response('Not authenticated!', 401);
      }

      $user->load('settings');

      // Check if user has settings
      if ($user->settings->count() <= 0) {
        return response('No settings found for the user.', 404);
      }

      return $user;
    }


    // Save setting
    public function changeSetting(Request $request)
    {
      // Validate request
      $this->validate($request, [
        'name' => 'required',
      ]);

      $user = $request->user();

      if (!$user) {
        return response('Not authenticated!', 401);
      }

      $settings = $user->settings()->where('name', $request->name)->firstOrFail();

      if (!$settings) {
        return response("Setting was not found.", 404);
      }

      $settings->value = $request->value;
      $settings->save();
    }

    // Get all categories
    public function getCategories()
    {
      $categories = Category::all();

      if (!$categories) {
        return response("No categories found", 404);
      }

      return Category::all();
    }
}
