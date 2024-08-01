<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use App\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepo;
    protected $userService;

    public function __construct(UserRepositoryInterface $userRepo, UserService $userService)
    {
        $this->userRepo = $userRepo;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userRepo->all();

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($users);
        }

        return view('admin.users.index', compact('users'));
    }

    public function create(Request $request)
    {
        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => 'Display form for creating a user.']);
        }

        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => 'User created successfully.', 'user' => $user], 201);
        }

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $user = $this->userRepo->find($id);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['user' => $user]);
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userRepo->find($id);
        $user = $this->userService->updateUser($user, $request->validated());

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => 'User updated successfully.', 'user' => $user]);
        }

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $user = $this->userRepo->find($id);
        $this->userRepo->delete($user);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => 'User deleted successfully.']);
        }

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function deleted(Request $request)
    {
        $users = $this->userRepo->onlyTrashed();

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json($users);
        }

        return view('admin.users.deleted', compact('users'));
    }

    public function restore(Request $request, $id)
    {
        $user = $this->userService->restoreUser($id);

        if ($user) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json(['message' => 'User restored successfully.']);
            }

            return redirect()->route('admin.users.deleted')->with('success', 'User restored successfully.');
        }

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        return redirect()->route('admin.users.deleted')->with('error', 'User not found.');
    }

    public function forceDelete(Request $request, $id)
    {
        $user = $this->userService->forceDeleteUser($id);

        if ($user) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json(['message' => 'User permanently deleted.']);
            }

            return redirect()->route('admin.users.deleted')->with('success', 'User permanently deleted.');
        }

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        return redirect()->route('admin.users.deleted')->with('error', 'User not found.');
    }

    public function toggleRole(Request $request, $id)
    {
        $user = $this->userRepo->find($id);
        $user = $this->userService->toggleUserRole($user);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => 'User role updated successfully.', 'user' => $user]);
        }

        return redirect()->route('admin.users')->with('success', 'User role updated successfully.');
    }

    public function toggleActive(Request $request, $id)
    {
        $user = $this->userRepo->find($id);
        $user = $this->userService->toggleUserActive($user);

        if ($request->is('api/*') || $request->expectsJson()) {
            return response()->json(['message' => 'User status updated successfully.', 'user' => $user]);
        }

        return redirect()->route('admin.users')->with('success', 'User status updated successfully.');
    }
}
