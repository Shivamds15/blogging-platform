@extends('layouts.app')

@section('content')

    <div class="home-container">
        @guest
            <h1 class="welcome-message">Welcome to Blogging Platform</h1>
            <p>Login to access your account or register to get started.</p>
            <div class="login-buttons">
                <a href="{{ route('login') }}" class="btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn-primary">Register</a>
            </div>
        @else
            <h1 class="welcome-message">Hello, {{ Auth::user()->name }}!</h1>
            <div class="login-buttons">
                <a href="{{ route('posts.index') }}" class="btn-secondary">View Blog Posts</a>
                <a href="{{ route('profile') }}" class="btn-secondary">View Profile</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <div>
                        <button type="submit" class="btn-primary">Logout</button>
                    </div>
                </form>
            </div>
        @endguest
    </div>

@endsection

    