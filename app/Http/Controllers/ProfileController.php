<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show()
    {
        $formConfig = config('formsfield.profileView');
        $user = Auth::user();
        return view('profile', compact('formConfig', 'user'));
    }

    public function edit()
    {
        $formConfig = config('formsfield.profileEdit');
        $user = Auth::user();
        return view('edit-profile', compact('formConfig', 'user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $user->profile_picture = $path;
        }
        $user->save();
        return redirect()->route('profile');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        DB::transaction(function () use ($user) {
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
            $user->delete();
        });
        Auth::logout();
        return redirect('/');
    }
}
