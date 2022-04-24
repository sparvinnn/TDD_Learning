<?php

namespace Tests\Feature\Models;

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
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
    }
}
