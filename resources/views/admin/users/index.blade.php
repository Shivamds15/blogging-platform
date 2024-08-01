@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container mt-5">

    <div class="card shadow-sm rounded mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h1 class="mb-0">Manage Users</h1>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create New User</a>
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    <div class="card shadow-sm rounded mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Registered At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('admin.users.toggleRole', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm">
                                            {{ $user->role === 'admin' ? 'Demote to Regular' : 'Promote to Admin' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('admin.users.toggleActive', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-{{ $user->active ? 'success' : 'warning' }} btn-sm">
                                            {{ $user->active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    </div>

</div>
@endsection
