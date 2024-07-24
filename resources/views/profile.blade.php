@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Profile</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}" 
                             alt="{{ $user->name }}" 
                             class="img-fluid rounded-circle" 
                             style="max-width: 150px;">
                    </div>

                    @foreach($formConfig as $field => $attributes)
                        <div class="form-group mb-3">
                            <label for="{{ $field }}" class="form-label">{{ $attributes['label'] }}</label>
                            @if($attributes['type'] == 'text' || $attributes['type'] == 'email')
                                <p id="{{ $field }}">{{ $user->$field }}</p>
                            @endif
                        </div>
                    @endforeach

                    <div class="form-group mb-3">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary w-100 mt-2">Edit Profile</a>
                    </div>

                    <div class="form-group mb-0">
                        <form action="{{ route('profile.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 mt-2" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
