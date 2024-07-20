@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm rounded">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>{{ __('Profile') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}" 
                                 alt="{{ $user->name }}" 
                                 class="img-fluid rounded-circle" 
                                 style="max-width: 150px;">
                        </div>

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <p id="name">{{ $user->name }}</p>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <p id="email">{{ $user->email }}</p>
                        </div>

                        <div class="form-group mb-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary w-100 mt-2">
                                {{ __('Edit Profile') }}
                            </a>
                            <a>
                                <form action="{{ route('profile.delete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100 mt-2" onclick="return confirm('Are you sure you want to delete your account?')">
                                        {{ __('Delete Account') }}
                                    </button>
                                </form>
                            </a>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
