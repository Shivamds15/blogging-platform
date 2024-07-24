@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-4">
                            <img id="profile-picture-preview" 
                                 src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}" 
                                 alt="{{ $user->name }}" 
                                 class="img-fluid rounded-circle" 
                                 style="max-width: 150px;">
                        </div>

                        @if($formConfig)
                            @foreach($formConfig as $field => $attributes)
                                <div class="form-group mb-3">
                                    <label for="{{ $field }}" class="form-label">{{ $attributes['label'] }}</label>
                                    <input id="{{ $field }}" 
                                           type="{{ $attributes['type'] }}" 
                                           class="form-control @error($field) is-invalid @enderror" 
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
                            <p>No form configuration found.</p>
                        @endif

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                        </div>
                    </form>
                    <button onclick="history.back()" class="btn btn-secondary w-100 mx-0">Back</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
