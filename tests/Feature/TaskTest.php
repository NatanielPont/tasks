<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    /**
     * A basic test example.
     * @test
     */
    public function todo()
    {
        $this->withoutExceptionHandling();
//        $this->assertTrue(true);
        //Prepare

        //Execute
        $response=$this->get('/tasks');
//        dd($response);

        //Assert
        $response->assertSuccessful();
        $response->assertSee('Tasques');
//        $this->assertEquals('/tasks',$this);

    }
}
