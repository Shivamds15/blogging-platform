 <nav class="navbar navbar-expand-lg navbar-light">
   
    <a class="navbar-brand" href="#">
        <i class="fas fa-blog"></i>&nbsp; Platform
    </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100 justify-content-end">
                @auth
                <div class="navbar-text d-flex align-items-center" style="color: #0000009e; font-weight: 300;">
                    @php
                        $routeName = Route::currentRouteName(); 
                        $showDeleted = request('show_deleted'); 
                        $userPosts = request('user_posts'); 
    
                        if ($routeName == 'admin.dashboard') {
                            $content = 'Admin Dashboard';
                        } elseif ($routeName == 'posts.create') {
                            $content = 'Create Post';
                        } elseif ($routeName == 'posts.index') {
                            if ($showDeleted) {
                                $content = Auth::user()->isAdmin() ? 'All Deleted Posts' : 'My Deleted Posts';
                            } elseif ($userPosts) {
                                $content = 'My Posts';
                            } else {
                                $content = 'All Posts';
                            }
                        } elseif ($routeName == 'posts.show') {
                            $content = 'Post Details';
                        } elseif ($routeName == 'posts.edit') {
                            $content = 'Edit Post';
                        } elseif ($routeName == 'admin.users.create') {
                            $content = 'Create User';
                        } elseif ($routeName == 'admin.users.edit') {
                            $content = 'Edit User';
                        } elseif ($routeName == 'admin.users') {
                            $content = 'All Users';
                        } elseif ($routeName == 'admin.users.deleted') {
                            $content = 'Deleted Users';
                        } elseif ($routeName == 'profile') {
                            $content = 'Profile Overview';
                        } elseif ($routeName == 'profile.edit') {
                            $content = 'Edit Profile ';
                        } elseif ($routeName == 'profile') {
                            $content = 'Profile Overview';
                        } else {
                            $content = 'Home';
                        }
                    @endphp
                    {{ $content }}
                </div>
                
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