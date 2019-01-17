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
        $this->loginAsSuperAdmin('api');
        $oldTag = factory(Tag::class)->create([
            'id'=>1,
            'name' => 'Tag1'
        ]);
//        $tag=Tag::create([
//            'name' => 'Tag1'
//        ]);
        $task=Task::create([
            'name'=>'Comprar pa',
            'completed'=> true,
            'description'=>'A',
        ]);
//                dd($tag);

        $response = $this->json('POST','/api/v1/tasks/'.$task->id.'/tag',[
            'tag' => ['id'=>$oldTag->id]
        ]);
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
//        $this->assertNotNull($taG = Tag::find($tag->id));
        $this->assertEquals('Tag1',$result->name);
//        dd($task->tags[0]->name);
        $this->assertEquals(1,$result->id);
    }

    /**
     * @test
     */
    public function superadmin_can_delete_tag_task()
    {
        $this->withoutExceptionHandling();
        $this->loginAsSuperAdmin('api');
        $tag = factory(Tag::class)->create([
            'id'=>1,
            'name' => 'Tag1'
        ]);
        $tag2 = factory(Tag::class)->create([
            'id'=>2,
            'name' => 'Tag2'
        ]);
//        $tag=Tag::create([
//            'name' => 'Tag1'
//        ]);
        $task=Task::create([
            'name'=>'Comprar pa',
            'completed'=> true,
            'description'=>'A',
        ]);
        $task->addTag($tag);
//        $task->addTag($tag2);
//                dd($tag);
//        dd($task->tags[0]);
        $this->assertNotNull($task->tags[0]);

        $response = $this->json('DELETE','/api/v1/tasks/'.$task->id.'/tag',[
            'tag' => ['id'=>$tag->id]
        ]);
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
//        dd($task->tags[0]['pivot']['tag_id']);
//        dd($result->tags);
        $this->assertEmpty($result->tags);
//        $this->assertNull($result->tags);
//        $this->assertDatabaseMissing();
//        $this->assertFalse('1',$result->tags[0]['id']);
//        dd($task->tags[0]->name);
//        $this->assertEquals(1,$result->id);
    }
}
