<!-- dashboard.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to Your Dashboard, {{ auth()->user()->name }}!</h1>
        
        <!-- Dashboard content goes here -->

        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
@endsection
