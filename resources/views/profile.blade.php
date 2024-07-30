@extends('layouts.app')

@section('content')
<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <h4>Profile Overview</h4>
        </div>
        <div class="profile-body">
            <div class="profile-image-container">
                <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}" 
                     alt="{{ $user->name }}" 
                     class="profile-image">
            </div>

            @foreach($formConfig as $field => $attributes)
                <div class="profile-info">
                    <label for="{{ $field }}" class="profile-label">{{ $attributes['label'] }}</label>
                    @if($attributes['type'] == 'text' || $attributes['type'] == 'email')
                        <p id="{{ $field }}" class="profile-data">{{ $user->$field }}</p>
                    @endif
                </div>
            @endforeach

            <div class="profile-actions">
                <a href="{{ route('profile.edit') }}" class="btn btn-edit">Edit Profile</a>
                <form action="{{ route('profile.delete') }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn w-100 btn-delete" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
