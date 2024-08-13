@extends('layouts.app')

@section('content')
<div class="edit-profile-container">
    <div class="edit-profile-card shadow-lg">
        <div class="edit-profile-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="edit-profile-form">
                @csrf
                @method('PUT')

                <div class="edit-profile-image-container">
                    <img id="profile-picture-preview" 
                         src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}" 
                         alt="{{ $user->name }}" 
                         class="edit-profile-image">
                </div>

                @if($formConfig)
                    @foreach($formConfig as $field => $attributes)
                        <div class="edit-profile-form-group">
                            <label for="{{ $field }}" class="edit-profile-label">{{ $attributes['label'] }}
                                @if(isset($attributes['required']) && $attributes['required'])
                                    <span class="text-danger">*</span>
                                @endif
                            </label>
                            <input id="{{ $field }}" 
                                   type="{{ $attributes['type'] }}" 
                                   class="edit-profile-input @error($field) is-invalid @enderror" 
                                   name="{{ $field }}" 
                                   value="{{ old($field, $user->$field) }}" 
                                   {{ $attributes['required'] ? 'required' : '' }}>
                            @error($field)
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    @endforeach
                @else
                    <p class="no-config-message">No form configuration found.</p>
                @endif

                <div class="edit-profile-actions">
                    <button type="submit" class="btn btn-update">Update Profile</button>
                    {{-- <button type="button" onclick="history.back()" class="btn btn-back">Back</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
