<?php

return [
    'profileEdit' => [
        'name' => [
            'label' => 'Name',
            'type' => 'text',
            'required' => true,
            'validation' => 'required|string|max:255',
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'email',
            'required' => true,
            'validation' => 'required|string|email|max:255|unique:users',
        ],
        'profile_picture' => [
            'label' => 'Profile Picture',
            'type' => 'file',
            'required' => false,
            'validation' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
    ],
    'profileView' => [
        'name' => [
            'label' => 'Name',
            'type' => 'text',
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'email',
        ],
    ],
    'postCreate' => [
        'title' => [
            'label' => 'Title',
            'type' => 'text',
            'rules' => 'required|string|max:255',
        ],
        'body' => [
            'label' => 'Body',
            'type' => 'textarea',
            'rules' => 'required|string',
        ],
    ],
    'postEdit' => [
        'title' => [
            'label' => 'Title',
            'type' => 'text',
            'rules' => 'required|string|max:255',
        ],
        'body' => [
            'label' => 'Body',
            'type' => 'textarea',
            'rules' => 'required|string',
        ],
    ],
];
