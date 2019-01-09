<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelpersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function create_primary_user()
    {
        $this->withoutExceptionHandling();

        create_primary_user();

        $user = User::where('email','npontcastells@gmail.com')->first();
        $this->assertEquals($user->name,'Nataniel Pont');
        $this->assertEquals($user->email,'npontcastells@gmail.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD','123456'), $user->password));

    }

    /**
     * @test
     */
    public function create_sergi_user()
    {
        $this->withoutExceptionHandling();

        create_sergi_user();

        $user = User::where('email','sergiturbadenas@gmail.com')->first();
        $this->assertEquals($user->name,'Sergi Tur');
        $this->assertEquals($user->email,'sergiturbadenas@gmail.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD','123456'), $user->password));

    }
}
