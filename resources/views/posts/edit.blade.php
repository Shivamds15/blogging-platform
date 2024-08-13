@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card shadow-lg rounded" style="max-width: 600px; width: 100%;">
            <div class="card-header bg-primary text-white text-center">
                <h2>Edit Post</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('posts.update', $post) }}">
                    @csrf
                    @method('PUT')

                    @foreach($formConfig as $field => $attributes)
                        <div class="form-group mb-4">
                            <label for="{{ $field }}" class="form-label">{{ $attributes['label'] }}
                                @if(isset($attributes['required']) && $attributes['required'])
                                    <span class="text-danger">*</span>
                                @endif
                            </label>

                            @if($attributes['type'] == 'text')
                                <input id="{{ $field }}" type="text" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror" value="{{ old($field, $post->$field) }}" placeholder="{{ $attributes['placeholder'] ?? '' }}" @if(isset($attributes['required']) && $attributes['required']) required @endif>
                            @elseif($attributes['type'] == 'textarea')
                                <textarea id="{{ $field }}" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror" rows="5" placeholder="{{ $attributes['placeholder'] ?? '' }}" @if(isset($attributes['required']) && $attributes['required']) required @endif>{{ old($field, $post->$field) }}</textarea>
                            @endif

                            @error($field)
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary btn-lg w-100">Update Post</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
