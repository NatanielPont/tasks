<?php

use App\Task;

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

//if (!function_exists('config')){
//
//    function config($key=null){
//        if (!$key) return App::resolve('config');
//        return App::resolve('config')[$key];
//    }
//}




