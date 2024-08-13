@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container d-flex flex-column" style="height: 100vh;">
    <div class="card shadow-sm rounded d-flex flex-fill flex-column">
        <div class="card-body flex-fill d-flex flex-column">
            <div class="flex-fill">
                <table class="table table-bordered table-striped w-100" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th style="text-align: center">Role</th>
                            <th style="text-align: center">Status</th>
                            <th>Registered At</th>
                            <th style="text-align: center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td style="text-align: center">
                                    <form action="{{ route('admin.users.toggleRole', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm">
                                            {{ $user->role === 'admin' ? 'Demote to Regular' : 'Promote to Admin' }}
                                        </button>
                                    </form>
                                </td>
                                <td style="text-align: center">
                                    <form action="{{ route('admin.users.toggleActive', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-{{ $user->active ? 'success' : 'warning' }} btn-sm">
                                            {{ $user->active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td style="display: flex; justify-content: center; gap: 0.5rem;">
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
</div>
@endsection
