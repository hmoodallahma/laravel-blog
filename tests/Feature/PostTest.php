<?php

namespace Tests\Feature;

use App\Models\Comment;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $anakin = User::factory()->anakin()->create();

        $post = Post::factory()->create(['author_id' => $anakin->id]);
        Post::factory()->count(2)->create();
        Comment::factory()->count(3)->create(['post_id' => $post->id]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Latest posts')
            ->assertSee($post->title)
            ->assertSee(humanize_date($post->posted_at))
            ->assertSee('3')
            ->assertSee('Anakin');
    }

    public function testSearch()
    {
        Post::factory()->count(3)->create();
        $post = Post::factory()->create(['title' => 'Hello Obiwan']);

        $this->get('/?q=Hello')
            ->assertOk()
            ->assertSee('1 post found')
            ->assertSee($post->title)
            ->assertSee(humanize_date($post->posted_at));
    }

    public function testShow()
    {
        $post = Post::factory()->create();
        Comment::factory()->count(2)->create(['post_id' => $post->id]);
        Comment::factory()->create(['post_id' => $post->id]);

        $this->actingAsUser()
            ->get("/posts/{$post->slug}")
            ->assertOk()
            ->assertSee($post->content)
            ->assertSee($post->title)
            ->assertSee(humanize_date($post->posted_at))
            ->assertSee('3 comments')
            ->assertSee('Comment');
    }

    public function testShowUnauthenticated()
    {
        $post = Post::factory()->create();

        $this->get("/posts/{$post->slug}")
            ->assertOk()
            ->assertSee('You must be signed in to comment.');
    }

    public function test_posts_can_have_category()
    {
        // Test that a newly created post can be assigned a category

        $user = User::factory()->create();
        $category = Category::factory()->create();
        $post = Post::factory()->create(['author_id' => $user->id]);
        
        $post->categories->add($category);

        $this->assertNotEmpty($post->categories);
    }

        public function test_post_can_have_categories()
    {
        // Test that posts can have multiple categoroes

        $user = User::factory()->create();
        $categories = Category::factory(5)->create();
        $post = Post::factory()->create(['author_id' => $user->id]);
        
        $post->categories()->saveMany($categories);

        $this->assertEquals($post->categories->count(), 5);
    }

}
