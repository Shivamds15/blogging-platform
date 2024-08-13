@extends('layouts.app')

@section('title', 'Deleted Users')

@section('content')
<div class="container d-flex flex-column" style="height: 100vh;">
    <div class="card shadow-sm rounded flex-fill d-flex flex-column">
        <div class="card-body flex-fill d-flex flex-column">
            <div class="table-container flex-fill">
                <table class="table table-striped table-bordered w-100" id="myTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th style="display: flex; justify-content: center; gap: 0.5rem;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td style="display: flex; justify-content: center; gap: 0.5rem;">
                                    <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                    </form>
                                    <form action="{{ route('admin.users.forceDelete', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No Deleted Users</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
