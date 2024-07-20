@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4>{{ __('Edit Profile') }}</h4>
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

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="profile_picture" class="form-label">{{ __('Profile Picture') }}</label>
                            <input id="profile_picture" style="background-color:#ededed;width:100%;border-radius: 0 5px 5px 0;;" type="file" @error('profile_picture') is-invalid @enderror" name="profile_picture">
                            @error('profile_picture')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </form>
                    <button onclick="history.back()" class="btn btn-secondary w-100 mx-0">
                        {{ __('Back') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
