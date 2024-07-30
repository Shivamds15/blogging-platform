<?php

namespace App\Http\Controllers;

use App\Repositories\ProfileRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileRepo;

    public function __construct(ProfileRepositoryInterface $profileRepo)
    {
        $this->profileRepo = $profileRepo;
    }

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

    public function update(UpdateProfileRequest $request)
    {

        $data = $request->only(['name', 'email']);

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture');
        }

        $this->profileRepo->updateUser(Auth::id(), $data);
        
        return redirect()->route('profile');
    }

    public function destroy(Request $request)
    {
        $this->profileRepo->deleteUser(Auth::id());
        Auth::logout();
        
        return redirect('/');
    }
}

