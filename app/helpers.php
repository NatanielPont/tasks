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
              try{
                  $user->assignRole('TaskManager');
            }catch (Exception $e){
                  dd('hola'.$e);

            }
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

//}
if (!function_exists('create_role')) {
    function create_role($role)
    {
        try {
            return Role::create([
                'name' => $role
            ]);
        } catch(Exception $e) {
            return Role::findByName($role);
        }
    }
}

if (!function_exists('create_permission')) {
    function create_permission($permission)
    {
        try {
            return Permission::create([
                'name' => $permission
            ]);
        } catch(Exception $e) {
            return Permission::findByName($permission);
        }
    }
}

if (!function_exists('initialize_roles')) {
    function initialize_roles() {
        $roles = [
            'TaskManager',
            'Tasks',
            'TagsManager',
            'Tags'
        ];
        foreach ($roles as $role) {
            create_role($role);
        }
        $taskManagerPermissions = [
            'tasks.index',
            'tasks.show',
            'tasks.store',
            'tasks.update',
            'tasks.complete',
            'tasks.uncomplete',
            'tasks.destroy'
        ];
        $tagsManagerPermissions = [
            'tags.index',
            'tags.show',
            'tags.store',
            'tags.update',
            'tags.complete',
            'tags.uncomplete',
            'tags.destroy'
        ];
        $userTaskPermissions = [
            'user.tasks.index',
            'user.tasks.show',
            'user.tasks.store',
            'user.tasks.update',
            'user.tasks.complete',
            'user.tasks.uncomplete',
            'user.tasks.destroy'
        ];
        $userTagsPermissions = [
            'user.tags.index',
            'user.tags.show',
            'user.tags.store',
            'user.tags.update',
            'user.tags.complete',
            'user.tags.uncomplete',
            'user.tags.destroy'
        ];
        $permissions = array_merge($taskManagerPermissions, $userTaskPermissions, $tagsManagerPermissions, $userTagsPermissions);
        foreach ($permissions as $permission) {
            create_permission($permission);
        }
        $rolePermissions = [
            'TaskManager' => $taskManagerPermissions,
            'Tasks' => $userTaskPermissions,
            'TagsManager' => $tagsManagerPermissions,
            'Tags' => $userTagsPermissions,
        ];
        foreach ($rolePermissions as $role => $rolePermission) {
            $role = Role::findByName($role);
            foreach ($rolePermission as $permission) {
                $role->givePermissionTo($permission);
            }
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
        try {
            $sergitur = factory(User::class)->create([
                'name' => 'Sergi Tur',
                'email' => 'sergiturbadenas@gmail.com',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD', 'secret'))
            ]);
            $sergitur->admin = true;
            $sergitur->save();
        } catch (Exception $e) {
        }
        Task::create([
            'name' => 'Tasca Sergi Tur',
            'completed' => false,
            'description' => 'Descripció de prova',
            'user_id' => $sergitur->id
        ]);
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



