@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

    <div class="container">
        <div class="card shadow-sm rounded">
            <div class="card-header bg-primary text-white text-center">
                <h2>Create a New Post</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title" class="form-label">{{ __('Title') }}</label>
                        <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="body" class="form-label">{{ __('Body') }}</label>
                        <textarea id="body" name="body" class="form-control @error('body') is-invalid @enderror" rows="5" required>{{ old('body') }}</textarea>
                        @error('body')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Create Post') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
