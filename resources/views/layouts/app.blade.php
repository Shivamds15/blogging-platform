<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Blogging Platform</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<script src="https://code.highcharts.com/highcharts.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-blog"></i> Blogging Platform
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100 justify-content-end">
                @auth
                @if(Auth::user()->isAdmin())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cogs"></i> Admin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="adminDropdown">
                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#" id="managePostsDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-pen"></i> Manage Posts
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="managePostsDropdown">
                                <li><a class="dropdown-item" href="{{ route('posts.create') }}"><i class="fas fa-plus"></i> Create Post</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="{{ route('posts.index') }}"><i class="fas fa-list"></i> All Posts</a></li>
                                <li><a class="dropdown-item" href="{{ route('posts.index', ['user_posts' => 'true']) }}"><i class="fas fa-user"></i> My Posts</a></li>
                                <li><a class="dropdown-item" href="{{ route('posts.index', ['show_deleted' => 'true']) }}"><i class="fas fa-trash"></i> Deleted Posts</a></li>
                            </ul>
                        </div>
                        <div class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#" id="manageUsersDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-users"></i> Manage Users
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="manageUsersDropdown">
                                <li><a class="dropdown-item" href="{{ route('admin.users.create') }}"><i class="fas fa-user-plus"></i> Create User</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="{{ route('admin.users') }}"><i class="fas fa-users"></i> All Users</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.users.deleted') }}"><i class="fas fa-user-slash"></i> Deleted Users</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="postsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-book"></i> Posts
                    </a>
                    <div class="dropdown-menu" aria-labelledby="postsDropdown">
                        <a class="dropdown-item" href="{{ route('posts.create') }}"><i class="fas fa-plus"></i> Create Post</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('posts.index') }}"><i class="fas fa-list"></i> All Posts</a>
                        <a class="dropdown-item" href="{{ route('posts.index', ['user_posts' => 'true']) }}"><i class="fas fa-user"></i> My Active Posts</a>
                        <a class="dropdown-item" href="{{ route('posts.index', ['show_deleted' => 'true']) }}"><i class="fas fa-trash"></i> My Deleted Posts</a>
                    </div>
                </li>
                @endif
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/default-profile.png') }}" 
                             alt="{{ Auth::user()->name }}" 
                             class="rounded-circle" 
                             style="width: 25px; height: 25px;"/>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user"></i> Profile View</a>
                        <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
                            @csrf
                            <a href="#" class="dropdown-item logout-link" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </form>
                    </div>
                </li>
                @else
                <!-- Guest Navigation -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="guestDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> Guest
                    </a>
                    <div class="dropdown-menu" aria-labelledby="guestDropdown">
                        <a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                        <a class="dropdown-item" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Register</a>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </nav>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>