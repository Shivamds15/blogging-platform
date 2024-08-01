@extends('layouts.app')

@section('content')
<div class="hero-container">
    @guest
        <div class="hero-content">
            <h1 class="hero-title">Welcome to the Blogging Platform</h1>
            <p class="hero-subtitle">Discover, create, and share amazing blog posts</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
            </div>
        </div>
    @else
        <div class="hero-content">
            <h2 class="hero-title">Hello, {{ Auth::user()->name }}!</h2>

            @if ($isAdmin)
                <p class="hero-subtitle">Explore and manage users and posts</p>
                <div class="admin-actions">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Admin Dashboard</a>
                </div>
            @else
                <p class="hero-subtitle">Explore new blog posts or manage your profile</p>
                <div class="user-actions">
                    <a href="{{ route('posts.index') }}" class="btn btn-primary">View Blog Posts</a>
                    <a href="{{ route('profile') }}" class="btn btn-secondary">View Profile</a>
                </div>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="btn btn-primary mt-2">Logout</button>
            </form>
        </div>
    @endguest
</div>
@endsection
