@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="container">
    <div class="main-postcontainer">
        <div class="postheader mb-4">
            <h2 class="text-center">
                @if (request('show_deleted'))
                    @if(Auth::user()->isAdmin())
                        All Deleted Posts
                    @else
                        {{ Auth::user()->name }}'s Deleted Posts
                    @endif
                @elseif (request('user_posts'))
                    {{ Auth::user()->name }}'s Active Posts
                @else
                    All Posts
                @endif
            </h2>
        </div>

        <div id="posts-list">
            @forelse ($posts as $post)
            <div id="post-{{ $post->id }}" class="post-item mb-4 p-3 border rounded shadow-sm {{ $post->deleted_at ? 'bg-light' : '' }}">
                <h3 class="post-title">
                    <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-primary">{{ $post->title }}</a>
                </h3>
                <p class="post-body">{{ Str::limit($post->body, 200) }}</p>
                <p class="text-muted">Posted by: {{ $post->user->name }} | Comments: {{ $post->comments->count() }} | Created on: {{ $post->created_at->format('d M Y, H:i') }}</p>
        
                @auth
                    @if(Auth::user()->isAdmin() || $post->user_id === Auth::id())
                        @if(request('show_deleted') && $post->deleted_at)
                            @if(Auth::user()->isAdmin())
                                <form action="{{ route('posts.restore', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                </form>
                                <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Permanently Delete</button>
                                </form>
                            @elseif($post->user_id === Auth::id())
                                <form action="{{ route('posts.restore', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                </form>
                                <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Permanently Delete</button>
                                </form>
                            @endif
                        @elseif(!$post->deleted_at)
                            @if(Auth::user()->isAdmin() || $post->user_id === Auth::id())
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        @endif
                    @endif
                @endauth
            </div>
        @empty
             <p class="post-item mb-4 p-3 border rounded shadow-sm text-center">No posts found.</p>
        @endforelse
        
        </div>

        <div class="mt-4 text-center" id="Pagination-Navpost">
            {{ $posts->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
