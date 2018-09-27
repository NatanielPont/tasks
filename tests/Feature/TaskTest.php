<?php
//psr-4
namespace Tests\Feature;

use App\Task;

//sufix as + alias;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    //refresh database
    use RefreshDatabase;


    /**
     * A basic test example.
     * @test
     */
    public function todo()
    {
        $this->withoutExceptionHandling();
//        $this->assertTrue(true);
        //Prepare
        Task::create([
            'name'=>'comprar pa',
            'completed'=> false
        ]);

        dd(Task::find(1));

        //Execute
        $response=$this->get('/tasks');
//        dd($response);

        //Assert
        $response->assertSuccessful();
        $response->assertSee('Tasques');
//        $this->assertEquals('/tasks',$this);

        //comprovar que es veuen les tasques q hi ha en la bd
        //preparar la bd a prepare

    }
}
