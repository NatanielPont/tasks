<?php

use App\Tag;
use App\Task;
use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            'completed'=> true,
            'description'=>'A',
            'user_id'=>1
        ]);
        Task::create([
            'name'=>'Comprar llet',
            'completed'=> false,
            'description'=>'b',
            'user_id'=>1
        ]);
        Task::create([
            'name'=>'Estudiar php',
            'completed'=> false,
            'description'=>'c',
            'user_id'=>1
        ]);
    }


}
if (!function_exists('create_primary_user')){
    function create_primary_user() {
        $user = User::where('email', 'npontcastells@gmail.com')->first();
        if (!$user) {
            $user=User::firstOrCreate([
                'name'=>'Nataniel Pont',
                'email'=>'npontcastells@gmail.com',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD','123456')),
            ]);
            $user->admin=true;
            $user->save();
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
        $statement = "GRANT ALL PRIVILEGES ON {$database}.* TO '{$user}'@'{$host}' WITH GRANT OPTION";
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

//other functions
if (!function_exists('initialize_roles')){
    function initialize_roles(){
        try{

        //crear roles
        $taskManager=Role::create([
            'name'=> 'TaskManager'
        ]);
        } catch (Exception $e){

        }
        try{

        //crear roles
        $tasks=Role::create([
            'name'=> 'Tasks'
        ]);
        } catch (Exception $e){

        }
        try{

            //crear permisos
            Permission::create([
                'name'=> 'tasks.index'
            ]);
            Permission::create([
                'name'=> 'tasks.show'
            ]);

            Permission::create([
                'name'=> 'tasks.store'
            ]);

            Permission::create([
                'name'=> 'tasks.update'
            ]);
            Permission::create([
                'name'=> 'tasks.destroy'
            ]);
            Permission::create([
                'name'=> 'tasks.complete'
            ]);
            Permission::create([
                'name'=> 'tasks.uncomplete'
            ]);

            //users permissions crud tasques users
            Permission::create([
                'name'=> 'user.tasks.index'
            ]);

            Permission::create([
                'name'=> 'user.tasks.show'
            ]);

            Permission::create([
                'name'=> 'user.tasks.store'
            ]);

            Permission::create([
                'name'=> 'user.tasks.update'
            ]);

            Permission::create([
                'name'=> 'user.tasks.destroy'
            ]);
        } catch (Exception $e){

        }
        try{

        $taskManager->givePermissionTo('tasks.index');
        $taskManager->givePermissionTo('tasks.show');
        $taskManager->givePermissionTo('tasks.store');
        $taskManager->givePermissionTo('tasks.update');
        $taskManager->givePermissionTo('tasks.complete');
        $taskManager->givePermissionTo('tasks.uncomplete');
        $taskManager->givePermissionTo('tasks.destroy');

            $tasks->givePermissionTo('user.task.index');
            $tasks->givePermissionTo('user.task.show');
            $tasks->givePermissionTo('user.task.store');
            $taskManager->givePermissionTo('user.task.complete');
            $taskManager->givePermissionTo('user.task.uncomplete');
            $tasks->givePermissionTo('user.task.update');
        } catch (Exception $e){

        }







    }
}

//TODO ->mk several users with different roles
//TODO -> gestionar superadmin
//TODO -> 2 types of user , 1 user with respective tasks, other taskManager
if (!function_exists('sample_users')){
    function sample_users(){
        try{

        //superadmin no cal

        //santi tola -> no te permis ni rol
        $santitola=factory(User::class)->create([
            'name'=>'Santi Tola',
            'email'=>'tola@hotmail.com'
        ]);
        $bartSimpson=factory(User::class)->create([
            'name'=>'Bart Simpson',
            'email'=>'bart@hotmail.com'
        ]);
        $homerSimpson=factory(User::class)->create([
            'name'=>'Homer Simpson',
            'email'=>'homer@hotmail.com'
        ]);
        }catch (Exception $e){

        }

        try{

        $bartSimpson->assignRole('Tasks');
        }catch (Exception $e){

        }

        try{
        $homerSimpson->assignRole('TasksManager');
        }catch (Exception $e){

        }
    }

}
if (!function_exists('map_collection')) {
    function map_collection($collection)
    {
        return $collection->map(function ($item) {
            return $item->map();
        });
    }
}
if (!function_exists('logged_user')) {
    function logged_user()
    {
        return json_encode(optional(Auth::user())->map());
    }
}



