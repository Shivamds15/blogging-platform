@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="content-wrapper">
    <div class="container flex-grow-1">
        <div class="row">
            @forelse ($posts as $post)
                <div id="post-{{ $post->id }}" class="col-md-6 mb-4">
                    <div class="post-item p-4 border rounded shadow-sm {{ $post->deleted_at ? 'bg-light' : 'bg-white' }}">
                        <h3 class="post-title mb-2">
                            <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-primary">{{ Str::limit($post->title, 40 ) }}</a>
                        </h3>
                        <p class="post-body mb-2">{{ Str::limit($post->body, 50) }}</p>

                        <div class="post-details d-flex justify-content-between align-items-center mt-3">
                            <p class="text-muted mb-0">
                                Posted: {{ $post->user ? $post->user->name : 'Unknown' }} | 
                                Comments: {{ $post->comments->count() }} | 
                                Created: {{ $post->created_at->format('d M Y, H:i') }}
                            </p>

                            @auth
                                @if(Auth::user()->isAdmin() || $post->user_id === Auth::id())
                                    <div class="post-actions d-flex gap-2" style="gap:0.5rem;">
                                        @if(request('show_deleted') && $post->deleted_at)
                                            <form action="{{ route('posts.restore', $post->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                            </form>
                                            <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        @elseif(!$post->deleted_at)
                                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <p class="post-item mb-4 p-4 border rounded w-100 shadow-sm text-center bg-white">No posts found.</p>
            @endforelse
        </div>
    </div>
    <div class="pagination-wrapper text-center mt-4">
        {{ $posts->appends(request()->query())->links() }}
    </div>
</div>
@endsection
