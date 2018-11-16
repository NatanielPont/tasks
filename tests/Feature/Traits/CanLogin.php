<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 15/11/18
 * Time: 19:44
 */

namespace Tests\Feature\Traits;


use App\User;

trait CanLogin
{
    /**
     * @param null $guard
     * @return mixed
     */
    protected function login($guard = null)
    {
        $user = factory(User::class)->create();
        $this->actingAs($user,$guard);
        return $user;
    }

}