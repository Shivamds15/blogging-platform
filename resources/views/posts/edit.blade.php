<!-- resources/views/posts/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

    <div class="container">
        <div class="card shadow-sm rounded">
            <div class="card-header bg-primary text-white text-center">
                <h2>Edit Post</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('posts.update', $post) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="title" class="form-label">{{ __('Title') }}</label>
                        <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="body" class="form-label">{{ __('Body') }}</label>
                        <textarea id="body" name="body" class="form-control @error('body') is-invalid @enderror" rows="5" required>{{ old('body', $post->body) }}</textarea>
                        @error('body')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Update Post') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    
@endsection
