@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card shadow-lg rounded" style="max-width: 500px; width: 100%;">
            <div class="card-header bg-primary text-white text-center">
                <h2>Edit User</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-2">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select id="role" name="role" class="form-control custom-select @error('role') is-invalid @enderror" required>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="regular" {{ old('role', $user->role) == 'regular' ? 'selected' : '' }}>Regular</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">Update User</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
