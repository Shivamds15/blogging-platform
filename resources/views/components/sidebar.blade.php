<div class="sidebar">
    <a class="sidebar-item no-hover" href="#">
        <i class="fas fa-blog"></i> 
        <span class="content">Blogging</span>
    </a>
    <a class="sidebar-item" href="{{ route('home') }}">
        <i class="fas fa-home"></i>
        <span class="content">Home</span>
    </a>
    <div class="sidebar-item sidebar-search">
        <i class="fas fa-search"></i>
        <input type="search" id="sidebar-search" class="content" placeholder="Search..." aria-label="Search" focus>
    </div>
  
    @auth
        @if(Auth::user()->isAdmin())
            <a class="sidebar-item sideSearch" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span class="content">Dashboard</span>
            </a>
            <a class="sidebar-item sideSearch" href="{{ route('posts.create') }}">
                <i class="fas fa-plus"></i>
                <span class="content">Create Post</span>
            </a>
            <a class="sidebar-item sideSearch" href="{{ route('posts.index') }}">
                <i class="fas fa-list"></i>
                <span class="content">All Posts</span>
            </a>
            <a class="sidebar-item sideSearch" href="{{ route('posts.index', ['user_posts' => 'true']) }}">
                <i class="fas fa-user"></i>
                <span class="content">Admin Posts</span>
            </a>
            <a class="sidebar-item sideSearch" href="{{ route('posts.index', ['show_deleted' => 'true']) }}">
                <i class="fas fa-trash"></i>
                <span class="content">Deleted Posts</span>
            </a>
            <a class="sidebar-item sideSearch" href="{{ route('admin.users.create') }}">
                <i class="fas fa-user-plus"></i>
                <span class="content">Create User</span>
            </a>
            <a class="sidebar-item sideSearch" href="{{ route('admin.users') }}">
                <i class="fas fa-users"></i>
                <span class="content">All Users</span>
            </a>
            <a class="sidebar-item sideSearch" href="{{ route('admin.users.deleted') }}">
                <i class="fas fa-user-slash"></i>
                <span class="content">Deleted Users</span>
            </a>
        @else
            <a class="sidebar-item sideSearch" href="{{ route('posts.create') }}">
                <i class="fas fa-plus"></i>
                <span class="content">Create Post</span>
            </a>
            <a class="sidebar-item sideSearch" href="{{ route('posts.index') }}">
                <i class="fas fa-list"></i>
                <span class="content">All Posts</span>
            </a>
            <a class="sidebar-item sideSearch" href="{{ route('posts.index', ['user_posts' => 'true']) }}">
                <i class="fas fa-user"></i>
                <span class="content">My Posts</span>
            </a>
            <a class="sidebar-item sideSearch" href="{{ route('posts.index', ['show_deleted' => 'true']) }}">
                <i class="fas fa-trash"></i>
                <span class="content">My Deleted Posts</span>
            </a>
        @endif
    @endauth
    <div class="sidebar-item sidebar-version">
        <i class="fas fa-cogs"></i>
        <span class="content">v1.0 - Blog Platform</span>
    </div>
</div>