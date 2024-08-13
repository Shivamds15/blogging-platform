@extends('layouts.app')

@section('content')
<div class="hero-container">
    <div class="hero-content">
        @guest
            <h1 class="hero-title">Welcome to Our Platform</h1>
            <p class="hero-subtitle">Discover, create, and share exceptional content</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
            </div>
        @else
            <h2 class="hero-title">Hello, {{ Auth::user()->name }}!</h2>
            @if ($isAdmin)
                <p class="hero-subtitle">Manage your site effectively</p>
                <div class="admin-actions">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Admin Dashboard</a>
                </div>
            @else
                <p class="hero-subtitle">Explore and manage your content</p>
                <div class="user-actions">
                    <a href="{{ route('posts.index') }}" class="btn btn-primary">View Posts</a>
                </div>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="btn btn-primary mt-3">Logout</button>
            </form>
        @endguest
    </div>
</div>
@endsection
