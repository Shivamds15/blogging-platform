@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="container">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <span class="row d-flex px-3 justify-content-between">
                <h2 class="mb-0">Posts</h2>
                <div>
                    @auth
                        <a href="{{ route('posts.index') }}" class="btn btn-info mx-2 {{ !request('user_posts') ? 'active' : '' }}">All Posts</a>
                        <a href="{{ route('posts.index', ['user_posts' => 'true']) }}" class="btn btn-info mx-2 {{ request('user_posts') ? 'active' : '' }}">My Posts</a>
                    @endauth
                    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
                </div>
            </span>
        </div>
        <div class="card-body">
            <h3>Active Posts</h3>
            <div id="active-posts">
                @forelse ($posts->whereNull('deleted_at') as $post)
                    <div id="post-{{ $post->id }}" class="post-item mb-4 p-3 border rounded shadow-sm">
                        <h3 class="post-title">
                            <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-primary">{{ $post->title }}</a>
                        </h3>
                        <p class="post-body">{{ Str::limit($post->body, 150) }}</p>
                        <p class="text-muted">Posted by: {{ $post->user->name }} | Comments: {{ $post->comments->count() }} | Created on: {{ $post->created_at->format('d M Y, H:i') }}</p>
                        
                        @auth
                            @if(request('user_posts') && $post->user_id === Auth::id())
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                @empty
                    <p>No active posts found.</p>
                @endforelse
            </div>

            @if(request('user_posts'))
                <h3 class="mt-5">Deleted Posts</h3>
                <div id="deleted-posts">
                    @forelse ($posts->whereNotNull('deleted_at') as $post)
                        <div id="post-{{ $post->id }}" class="post-item mb-4 p-3 border rounded shadow-sm bg-light">
                            <h3 class="post-title">{{ $post->title }}</h3>
                            <p class="post-body">{{ Str::limit($post->body, 150) }}</p>
                            <p class="text-muted">Deleted on: {{ $post->deleted_at->format('d M Y, H:i') }}</p>

                            <form action="{{ route('posts.restore', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                            <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Permanently Delete</button>
                            </form>
                        </div>
                    @empty
                        <p>No deleted posts found.</p>
                    @endforelse
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
