<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelpersTest extends TestCase
{
    /**
     * @test
     */
    public function create_primary_user()
    {
        create_primary_user();

        $user = User::where('email','npontcastells@gmail.com')->first();
        $this->assertEquals($user->name,'Nataniel Pont');
        $this->assertEquals($user->email,'npontcastells@gmail.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD','123456'), $user->password));

    }
}
