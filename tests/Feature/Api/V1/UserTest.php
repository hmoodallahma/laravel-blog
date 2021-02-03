<?php

namespace Tests\Feature\Api\V1;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserIndex()
    {
        $user = User::factory()->anakin()->create();
        Post::factory(20)->create(['author_id' => $user->id]);

        $this->json('GET', '/api/v1/user_posts/')
            ->assertOk();
            // ->assertJsonStructure([
            //     'data' => [[
            //         'id',
            //         'name',
            //         'email',
            //         'provider',
            //         'provider_id',
            //         'registered_at',
            //         'comments_count',
            //         'posts_count',
            //         'roles' => [[
            //             'id',
            //             'name'
            //         ]]
            //     ]],
            //     'links' => [
            //         'first',
            //         'last',
            //         'prev',
            //         'next',
            //     ],
            //     'meta' => [
            //         'current_page',
            //         'from',
            //         'last_page',
            //         'path',
            //         'per_page',
            //         'to',
            //         'total',
            //     ]
            // ]);
    }

    public function testUserShow()
    {
        $user = User::factory()->anakin()->create();
        
        Post::factory()->count(2)->create(['author_id' => $user->id]);

        $this->json('GET', "/api/v1/user_posts/search?=a")
            ->assertOk();
          
    }

   
    /**
     * Valid params for updating or creating a resource
     *
     * @param  array $overrides new params
     * @return array Valid params for updating or creating a resource
     */
    private function validParams($overrides = [])
    {
        return array_merge([
            'name' => 'Anakin',
            'email' => 'anakin@skywalker.st',
        ], $overrides);
    }
}
