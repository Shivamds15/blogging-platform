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

                @foreach($formConfig as $field => $attributes)
                    <div class="form-group mb-3">
                        <label for="{{ $field }}" class="form-label">{{ $attributes['label'] }}</label>

                        @if($attributes['type'] == 'text')
                            <input id="{{ $field }}" type="text" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror" value="{{ old($field) }}" required>
                        @elseif($attributes['type'] == 'textarea')
                            <textarea id="{{ $field }}" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror" rows="5" required>{{ old($field) }}</textarea>
                        @endif

                        @error($field)
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary w-100">Create Post</button>
            </form>
        </div>
    </div>
</div>
@endsection
