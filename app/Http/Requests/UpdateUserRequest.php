<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to false if you want to add authorization logic
    }

    public function rules()
    {
        $userId = $this->route('user'); // Get user ID from the route

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,regular',
        ];
    }
}
