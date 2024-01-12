<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   // Show the user's dashboard
   public function showDashboard()
   {
       return view('dashboard');
   }

   public function profile()
    {
        $user = Auth::user();
        $posts = $user->posts;

        return view('users.profile', compact('user', 'posts'));
    }
}
