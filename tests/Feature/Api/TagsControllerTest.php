<?php
//psr-4
namespace Tests\Feature\Api;

use App\Tag;
use App\Task;

//sufix as + alias;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsControllerTest extends TestCase
{
    //refresh database
    use RefreshDatabase,CanLogin;


    /**
     * A basic test example.
     * @test
     */
    public function can_show_tags()
    {
        $this->withoutExceptionHandling();
        $this->login('api');
        $this->assertTrue(true);
        //302 comprovar que es redirecciona
        //Prepare
        $tag=factory(Tag::class)->create([
            'name' => 'Comprar pa'
        ]);

////        $tag=Tag::create([
////            'name'=>'Comprar pa',
////            'description'=> 'holala',
////            'color'=> '#000000'
////        ]);

        //Execute
        $response=$this->json('GET','/api/v1/tags');
//        dd('hola');
//        dd($response->getContent());

        //Assert
        $response->assertSuccessful();
//        $response->assertSee('Tasques');
        $this->assertDatabaseHas('tags',['name'=>'Comprar pa']);
//        $response->assertsee('Comprar pa');
//        $response->assertSee('Comprar llet');
//        $response->assertSee('Estudiar php');

        //comprovar que es veuen les tasques q hi ha en la bd
        //preparar la bd a prepare

    }

    /**
     * @test
     */
    public function can_delete_tag()
    {
        $this->login('api');
        $this->withoutExceptionHandling();
        $tag = factory(Tag::class)->create();
        $response = $this->json('DELETE','/api/v1/tags/' . $tag->id);
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('', $result);
        $this->assertNull(Task::find($tag->id));
    }
    /**
     * @test
     */
    public function cannot_create_tags_without_name()
    {
        $this->login('api');
//        $this->withoutExceptionHandling();
        $response = $this->json('POST','/api/v1/tags/',[
            'name' => ''
        ]);
        $response->assertStatus(422);
    }
    /**
     * @test
     */
    public function can_create_tag()
    {
        $this->login('api');
        $this->withoutExceptionHandling();
        $response = $this->json('POST','/api/v1/tags/',[
            'name' => 'Comprar pa',
//            'description'=>'asdf'
        ]);
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
//        $this->assertDatabaseHas('tags', [ 'name' => 'Comprar pa' ]);
        $this->assertNotNull($tag = Tag::find($result->id));
        $this->assertEquals('Comprar pa',$result->name);
//        $this->assertFalse($result->completed);
    }
    /**
     * @test
     */
    public function can_list_tags()
    {
        $this->login('api');
        $this->withoutExceptionHandling();
        create_example_tags();
        $response = $this->json('GET','/api/v1/tags');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(3,$result);
        $this->assertEquals('Tag1', $result[0]->name);
//        $this->assertFalse((boolean)$result[0]->completed);
        $this->assertEquals('Tag2', $result[1]->name);
//        $this->assertFalse((boolean) $result[1]->completed);
        $this->assertEquals('Tag3', $result[2]->name);
//        $this->assertTrue((boolean) $result[2]->completed);
    }
    /**
     * @test
     */
    public function can_edit_tag()
    {
        $this->login('api');
        $oldTag = factory(Tag::class)->create([
            'name' => 'Comprar llet'
        ]);
        // 2
        $response = $this->json('PUT','/api/v1/tags/' . $oldTag->id, [
            'name' => 'Comprar pa'
        ]);
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $newTag = $oldTag->refresh();
        $this->assertNotNull($newTag);
        $this->assertEquals('Comprar pa',$result->name);
//        $this->assertFalse((boolean) $newTag->completed);
    }
    /**
     * @test
     */
    public function cannot_edit_tag_without_name()
    {
        $this->login('api');
//        $this->withoutExceptionHandling();
        $oldTag = factory(Tag::class)->create();
        $response = $this->json('PUT','/api/v1/tags/' . $oldTag->id, [
            'name' => ''
        ]);
        $response->assertStatus(422);
    }


}
