<?php

use App\Tag;
use App\Task;
use App\User;
use Illuminate\Support\Facades\DB;

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

if (!function_exists('create_mysql_database')){
    function create_mysql_database($dbname){
        //PDO
        //mysql: CREATE DATABASE if not exist DBNAME
        //
        $statement="CREATE DATABASE IF NOT EXISTS $dbname";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
    }

}
if (!function_exists('create_mysql_user')){
    function create_mysql_user($name, $password=null,$host='localhost'){
        if (!$password) $password=str_random();
        $statement= "CREATE USER IF NOT EXISTS {$name}@{$host}";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
        $statement= "ALTER USER '{$name}'@'{$host}' IDENTIFIED BY '{$password}'";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
        return $password;


    }
}

if (!function_exists('grant_mysql_privileges')){
    function grant_mysql_privileges($user, $database=null,$host='localhost'){
        $statement = "GRANT ALL PRIVILEGES ON {$database} TO '{$user}'@'{$host}' WITH GRANT OPTION";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
        $statement = "FLUSH PRIVILEGES";
        DB::connection('mysqlroot')->getPdo()->exec($statement);



    }

}

if (!function_exists('create_database')){
    function create_database(){
        create_mysql_database(env('DB_DATABASE'));
        create_mysql_user(env('DB_USERNAME'),env('DB_PASSWORD'));
        grant_mysql_privileges(env('DB_USERNAME'),env('DB_DATABASE'));


    }
}





