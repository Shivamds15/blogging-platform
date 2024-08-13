@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 d-flex flex-column">
            <div class="card shadow-lg rounded mb-4 d-flex flex-column" style="height: 100%; height: 83vh;">
                <div class="card-header bg-primary text-white border-0 rounded-top">
                    <h2 class="mb-0">{{ $post->title }}</h2>
                </div>
                <div class="card-body d-flex flex-column" style="flex: 1; overflow-y: auto;">
                    @if (empty($post->body))
                        <p class="text-center">No Description Yet!</p>
                    @else
                        <p>{{ $post->body }}</p>
                    @endif
                </div>
                @auth
                    @if ($post->user_id === Auth::id() || Auth::user()->isAdmin())
                        <div class="card-footer d-flex justify-content-center align-items-center bg-light border-0 rounded-bottom" style="gap:1em;">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>

        <div class="col-md-5 d-flex flex-column">
            <div class="card shadow-lg rounded flex-grow-1" style="height: 100%; height: 83vh;">
                <div class="card-header bg-secondary text-white d-flex justify-content-between border-0 rounded-top">
                    <h3 class="mb-0">Comments</h3>
                    @auth
                        <button id="openCommentModal" class="btn btn-primary btn-sm">Add</button>
                    @endauth
                </div>
                <div class="card-body d-flex flex-column" style="flex: 1; max-height: 500px; overflow-y: auto;">
                    @if ($post->comments->isEmpty())
                        <p class="text-center">No Comments Yet!</p>
                    @else
                        @foreach ($post->comments as $comment)
                            <div id="comment-{{ $comment->id }}" class="border-bottom mb-2 pb-2 d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="mb-2">{{ $comment->body }}</p>
                                    <p class="text-muted mb-0"><small>by : {{ $comment->user->name }}</small></p>
                                </div>
                                @auth
                                    @if($comment->user_id === Auth::id() || Auth::user()->isAdmin())
                                        <div class="h-100 align-content-center">
                                            <button class="delete-comment-btn btn btn-danger btn-sm" data-id="{{ $comment->id }}">Delete</button>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    @auth
        <div id="commentModal" class="modal fade" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentModalLabel">Add Comment</h5>
                        <button type="button" class="comm-btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="form-group mb-3">
                                <label for="comment-body" class="form-label">Comment: <span class="text-danger">*</span></label>
                                <textarea id="comment-body" name="body" class="form-control @error('body') is-invalid @enderror" rows="3" required></textarea>
                                @error('body')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Add Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
</div>
@endsection
