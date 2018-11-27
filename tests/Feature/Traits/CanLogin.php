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
    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginAsTaskManager($guard = null)
    {
        initialize_roles();
        $user = factory(User::class)->create();
        $user->assignRole('TaskManager');
        $this->actingAs($user,$guard);
        return $user;
    }
    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginAsUsingRole($guard,$role)
    {
        initialize_roles();
        $user = factory(User::class)->create();
        $user->assignRole($role);
        $this->actingAs($user,$guard);
        return $user;
    }
    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginWithPermission($guard = null,$permission)
    {
        $user = factory(User::class)->create();
        Permission::create([
            'name' => $permission
        ]);
        $user->givePermissionTo($permission);
        $this->actingAs($user,$guard);
        return $user;
    }
    protected function loginAsSuperAdmin($guard = null)
    {
        $user = factory(User::class)->create();
        $user->admin = true;
        $user->save();
        $this->actingAs($user,$guard);
        return $user;
    }

}