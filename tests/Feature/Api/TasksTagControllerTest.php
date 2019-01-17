<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 11/10/18
 * Time: 19:24
 */

namespace Tests\Feature\Api;


use App\Tag;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TasksTagControllerTest extends TestCase
{
    use RefreshDatabase,CanLogin;
    /**
     * @test
     */
    public function superadmin_can_create_tag_task()
    {
        $this->withoutExceptionHandling();
        $user=$this->loginAsSuperAdmin('api');
        $tag=Tag::create([
            'id'=>1,
            'name' => 'Tag1'
        ]);
        $task=Task::create([
            'name'=>'Comprar pa',
            'completed'=> true,
            'description'=>'A',
            'user_id'=>$user->id
        ]);

        $response = $this->json('POST','/api/v1/tasks/'.$task->id.'/tag',[
            'name' => $tag->name
        ]);
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertNotNull($taG = Tag::find($tag->id));
        $this->assertEquals('Tag1',$result->name);
//        dd($task->tags[0]->name);
        $this->assertEquals($tag->name,$task->tags[0]->name);
    }
}
