<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function isSuperAdmin()
    {
        $user=factory(User::class)->create();
        $this->assertFalse($user->isSuperAdmin);
        $user->admin=true;
        $user->save();
        $this->assertTrue($user->isSuperAdmin);

    }
}
