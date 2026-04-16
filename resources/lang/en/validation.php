<?php

return [

    'name' => [
        'required' => 'Name is required',
        'string' => 'Name must be a string',
        'min' => 'Name must be at least 3 characters',
        'max' => 'Name is too long',
        'regex' => 'Name must contain letters only',
    ],

    'email' => [
        'required' => 'Email is required',
        'email' => 'Invalid email format',
        'unique' => 'Email already exists',
    ],

    'phone' => [
        'required' => 'Phone number is required',
        'regex' => 'Invalid phone number',
        'unique' => 'Phone number already exists',
    ],

    'login' => [
        'required' => 'data enter is required',
        'invald' => 'invalid credintial',
    ],

    'password' => [
        'required' => 'Password is required',
        'confirmed' => 'Password confirmation does not match',
        'min' => 'Password must be at least 8 characters',
        'rules' => 'Password must contain:
        - Letters (a-z)
        - Uppercase letter (A-Z)
        - Number (0-9)
        - Special character (@$!%*?&)
        - At least 8 characters',
    ],
];
