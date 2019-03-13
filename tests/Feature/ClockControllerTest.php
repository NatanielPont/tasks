<?php
namespace Tests\Feature;
use App\Photo;
use App\User;
use Illuminate\Http\UploadedFile;
//use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use File;
//use Event;
//use Event;
class ClockControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function show_user__photo()
    {
        $this->login('web');
        $response = $this->get('/clock');
        $response->assertSuccessful();
    }
}
