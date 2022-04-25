<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_insert_data()
    {
        $data = User::factory()->make()->toArray();

//        dd($data);
        $data['password'] = 123456;

        User::create($data);

        $this->assertDatabaseHas('users', $data);

//        $this->assertDatabaseCount('users', 1);

    }

    public function test_user_relationship_with_post(){
        $count = rand(1,10);

        $user = User::factory()
            ->hasPosts($count)
            ->create();

        $this->assertCount($count, $user->posts);
//        instanceof check equal type right and left side
        $this->assertTrue($user->posts->first() instanceof Post);
    }

    public function test_user_relationship_with_user(){
        $count = rand(1,10);

        $user = User::factory()
            ->hasComments($count)
            ->create();

        $this->assertCount($count, $user->comments);
//        instanceof check equal type right and left side
        $this->assertTrue($user->comments->first() instanceof Comment);
    }
}
