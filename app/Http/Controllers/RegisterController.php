<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
   // Show registration form
   public function showRegistrationForm()
   {
       return view('auth.register');
   }

   // Handle registration form submission
   public function register(Request $request)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string|min:8|confirmed',
       ]);

       User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
       ]);

       // You may customize the logic after registration, like redirecting to a specific page
       return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
   }
}
