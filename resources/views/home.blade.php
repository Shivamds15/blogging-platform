@extends('layouts.app')

@section('content')
<div class="hero-container">
    @guest
        <div class="hero-content">
            <h1 class="hero-title">Welcome to Our Blogging Platform</h1>
            <p class="hero-subtitle">Discover, create, and share amazing blog posts.</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
            </div>
        </div>
    @else
        <div class="hero-content">
            <h1 class="hero-title">Hello, {{ Auth::user()->name }}!</h1>
            <p class="hero-subtitle">Explore new blog posts or manage your profile.</p>
            <div class="hero-buttons">
                <a href="{{ route('posts.index') }}" class="btn btn-primary">View Blog Posts</a>
                <a href="{{ route('profile') }}" class="btn btn-secondary">View Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    @endguest
</div>
@endsection
