<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 17/02/19
 * Time: 2:13
 */
return [
    /*
    |--------------------------------------------------------------------------
    | MANAGER EMAIL
    |--------------------------------------------------------------------------
    |
    | Bla bla bla
    |
    */
    'manager_email' => env('TASKS_MANAGER_EMAIL', 'tasksmanager@miempresa.com'),
    /*
    |--------------------------------------------------------------------------
    | SALT
    |--------------------------------------------------------------------------
    |
    | Used with hashids.
    |
    */
    'salt' => env('TASKS_SALT'),
    // MAIN APP
    'admin_user_email' => env('ADMIN_USER_EMAIL','npontcastells@gmail.com'),
    'admin_user_name' => env('ADMIN_USER_NAME','Nataniel Pont'),
    'admin_user_password' => env('ADMIN_USER_PASSWORD','123456')
];
