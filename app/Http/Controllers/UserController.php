<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
   // Show the user's dashboard
   public function showDashboard()
   {
       return view('dashboard');
   }
}
