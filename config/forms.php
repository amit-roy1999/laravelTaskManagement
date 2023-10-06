<?php

return [
    //login form for admin
    'adminLogin' => [
        'class' => "mt-8 space-y-6 columns-1",
        'function' => "login",
        'buttonText' => 'Login to your account',
        'validation' => [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'rememberMe' => 'nullable|bool',
        ],
        'fildes' => [
            [
                'name' => 'Your Email',
                'placeholder' => 'Enter Your Email',
                'id' => 'email',
                'type' => 'email',
                'wireName' => 'email',
            ],
            [
                'name' => 'Your Password',
                'placeholder' => 'Enter Your Password',
                'id' => 'password',
                'type' => 'password',
                'wireName' => 'password',
            ],
            [
                'name' => 'Your Password',
                'placeholder' => 'Enter Your Password',
                'id' => 'checkbox',
                'wireName' => 'rememberMe',
                'type' => 'rememberMeForgotPassword',
                'redirectRouteName' => 'register',
                'redirectText' => 'Sign Up',
            ],
        ]
    ],
    'register' => [
        'class' => "mt-8 space-y-6 columns-1",
        'function' => "register",
        'buttonText' => 'Register your account',
        'validation' => [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'rememberMe' => 'nullable|bool',
        ],
        'fildes' => [
            [
                'name' => 'Your Name',
                'placeholder' => 'Enter Your Name',
                'id' => 'name',
                'type' => 'text',
                'wireName' => 'name',
            ],
            [
                'name' => 'Your Email',
                'placeholder' => 'Enter Your Email',
                'id' => 'email',
                'type' => 'email',
                'wireName' => 'email',
            ],
            [
                'name' => 'Your Password',
                'placeholder' => 'Enter Your Password',
                'id' => 'password',
                'type' => 'password',
                'wireName' => 'password',
            ],
            [
                'name' => 'Confirm Password',
                'placeholder' => 'Enter Confirm Password',
                'id' => 'password_confirmation',
                'type' => 'password',
                'wireName' => 'password_confirmation',
            ],
            [
                'id' => 'checkbox',
                'wireName' => 'rememberMe',
                'type' => 'rememberMeForgotPassword',
                'redirectRouteName' => 'login',
                'redirectText' => 'Sign In',
            ],
        ]
    ],
];
