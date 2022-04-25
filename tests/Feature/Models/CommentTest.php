<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_insert_data()
    {
        $data = Comment::factory()->make()->toArray();
        Comment::create($data);

        $this->assertDatabaseHas('comments', $data);
    }

    public function test_comment_relationship_with_post(){
        $comment = Comment::factory()
            ->hasCommentable(Post::factory())
            ->create();
//
        $this->assertTrue(isset($comment->commentable->id));
        $this->assertTrue($comment->commentable->first() instanceof Post);
    }

    public function test_comment_relationship_with_user(){

        $comment = Comment::factory()
            ->for(User::factory())
            ->create();

        $this->assertTrue(isset($comment->user->id));
        $this->assertTrue($comment->user instanceof  User);
    }
}
