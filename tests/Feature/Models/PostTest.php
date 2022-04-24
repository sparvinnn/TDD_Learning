<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_insert_data()
    {
        $data = Post::factory()->make()->toArray();
        Post::create($data);

        $this->assertDatabaseHas('posts', $data);
    }

    public function test_post_relationship_with_user(){

        $post = Post::factory()
            ->for(User::factory())
            ->create();

        $this->assertTrue(isset($post->user->id));
//        instanceof check equal type right and left side
        $this->assertTrue($post->user instanceof  User);
    }
}
