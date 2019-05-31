<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        create_example_tags();
        create_example_tasks();
        initialize_roles();
        create_primary_user();
        sample_logs();
        create_sergi_user();
        create_miro_user();
        sample_users_and_tasks();
        initialize_user_default_image();
        //crear usuaris de proves
        //TODO rols per defecte en registrarse els usuaris
    }
}
