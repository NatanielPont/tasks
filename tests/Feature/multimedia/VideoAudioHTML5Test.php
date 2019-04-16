<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 15/04/19
 * Time: 17:17
 */

namespace Tests\Feature\multimedia;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class VideoAudioHTML5Test extends TestCase
{
    use RefreshDatabase,CanLogin;
    /** @test */
    public function showindex()
    {
        $this->withoutExceptionHandling();
        $this->login();
        $response = $this->get('/multimedia');
        $response->assertSuccessful();
        $response->assertViewIs('multimedia.index');
//        $response->assertRedirect('/login');
    }

}
