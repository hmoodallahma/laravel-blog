<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class PostObserver
{

    /**
     * Listen to the Post saving event to check if slug is duplicated
     */
    public function saving(Post $post)
    {
        
        if(empty($post->categories()))
        {
            echo($post->categories.' categories');
            $post->categories()->save(Category::where('name', 'General'));
        }
    }

    /**
     * Listen to the Post saving event to check if slug is duplicated
     */
    // public function creating(Post $post): void
    // {
    //     if (Post::whereSlug($slug = Str::slug($post->title))->exists()) {

    //         $post->slug = $this->incrementSlug($slug);
    //     }  

        
    // }

    // public function incrementSlug($slug)
    // {

    //     $original = $slug;

    //     $count = 2;

    //     while (Post::whereSlug($slug)->exists()) {

    //         $slug = "{$original}-" . $count++;
    //     }

    //     return $slug;

    // }
}
