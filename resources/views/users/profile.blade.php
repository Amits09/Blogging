
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $user->name }}'s Profile</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">User Information</h5>
                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                <!-- Add more user details as needed -->
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Authored Posts</h5>

                @if($posts->count() > 0)
                    @foreach($posts as $post)
                        <div class="mb-3">
                            <h6 class="card-subtitle mb-2 text-muted">{{ $post->title }}</h6>
                            <p class="card-text">{{ $post->content }}</p>
                            <!-- Additional post details... -->
                        </div>
                    @endforeach
                @else
                    <p>No authored posts yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
