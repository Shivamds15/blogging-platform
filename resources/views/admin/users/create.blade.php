@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white text-center">
            <h2>Create a New User</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-control custom-select @error('role') is-invalid @enderror" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="regular">Regular</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Create User</button>
            </form>
        </div>
    </div>
</div>
@endsection
