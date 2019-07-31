<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'faculties',
        
         //'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
       

        'admins' => [
            'driver' => 'jwt',
            'provider' => 'user_admins',
            
        ],


        'sub_admins' => [
            'driver' => 'jwt',
            'provider' => 'user_sub_admins',
            
        ],

        'students' => [
            'driver' => 'jwt',
            'provider' => 'user_students',
            
        ],

         'faculties' => [
            'driver' => 'jwt',
            'provider' => 'user_faculties',
            
        ],

        'faculty_heads' => [
            'driver' => 'jwt',
            'provider' => 'user_faculty_heads',
            
        ],

         'web' => [
            'driver' => 'session',
            'provider' => 'user_teachers',
            
        ],

        // 'api' => [
        //     'driver' => 'token',
        //     'provider' => 'user_admins',
        //     'provider' => 'user_students',
        //     'provider' => 'user_teachers',
        //     'provider' => 'user_staffs',
        //     'hash' => false,
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'user_faculties' => [
            'driver' => 'eloquent',
            'model' => App\Models\faculty\user_faculty::class,
        ],

        'user_faculty_heads' => [
            'driver' => 'eloquent',
            'model' => App\Models\faculty\user_faculty_head::class,
        ],

        'user_sub_admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\sub_admin\user_sub_admin::class,
        ],

        'user_students' => [
            'driver' => 'eloquent',
            'model' => App\Models\student\user_student::class,
        ],

        'user_admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\admin\user_admin::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 500,
        ],
    ],

];
