<?php

use App\Tag;
use App\Task;
use App\User;
if (!function_exists('create_example_tags')) {
    function create_example_tags() {
        Tag::create([
            'name' => 'Tag1',
            'description' => 'Bla bla bla',
            'color' => '#123456'
        ]);
        Tag::create([
            'name' => 'Tag2',
            'description' => 'Bla bla bla',
            'color' => '#123456'
        ]);
        Tag::create([
            'name' => 'Tag3',
            'description' => 'Bla bla bla',
            'color' => '#123456'
        ]);
    }
}
if (!function_exists('create_example_tasks')){
    function create_example_tasks(){
        Task::create([
            'name'=>'Comprar pa',
            'completed'=> true
        ]);
        Task::create([
            'name'=>'Comprar llet',
            'completed'=> false
        ]);
        Task::create([
            'name'=>'Estudiar php',
            'completed'=> false
        ]);
    }


}
if (!function_exists('create_primary_user')){
    function create_primary_user() {
        $user = User::where('email', 'npontcastells@gmail.com')->first();
        if (!$user) {
            User::firstOrCreate([
                'name'=>'Nataniel Pont',
                'email'=>'npontcastells@gmail.com',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD','123456'))
            ]);
        }
    }
}





