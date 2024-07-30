@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container">

    <div class="card shadow-sm rounded mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">{{ $post->title }}</h2>
        </div>
        <div class="card-body">
            <p>{{ $post->body }}</p>
            @auth
                @if ($post->user_id === Auth::id())
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary btn-danger">Delete</button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <div class="card shadow-sm rounded">
        <div class="card-header bg-secondary text-white d-flex justify-content-between">
            <h3 class="mb-0">Comments</h3>
            <button id="openCommentModal" class="btn btn-primary">Add Comment</button>
        </div>
        <div class="card-body card-body-comments"> <!-- Updated class here -->
            @foreach ($post->comments as $comment)
                <div id="comment-{{ $comment->id }}" class="border-bottom mb-3 pb-2 commbody">
                    <div class="commLeft">
                        <p>{{ $comment->body }}</p>
                        <p class="text-muted"><small>by : {{ $comment->user->name }}</small></p>
                    </div>
                    @auth
                        @if($comment->user_id === Auth::id())
                            <div class="commright">
                                <button class="delete-comment-btn btn btn-primary btn-danger btn-sm" data-id="{{ $comment->id }}">Delete</button>
                            </div>
                        @endif
                    @endauth
                </div>
            @endforeach

            @auth
                <div id="commentModal" class="modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Comment</h5>
                                <button type="button" class="btn-close btn cmmClose" data-bs-dismiss="modal" aria-label="Close">x</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="form-group mb-3">
                                        <label for="comment-body" class="form-label">Comment:</label>
                                        <textarea id="comment-body" name="body" class="form-control @error('body') is-invalid @enderror" rows="4" required></textarea>
                                        @error('body')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        Add Comment
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection

   