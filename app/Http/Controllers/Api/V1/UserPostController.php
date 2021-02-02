<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post as PostResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserPostController extends Controller
{
    /**
     * Return the user's posts.
     */
    public function index(Request $request, User $user): ResourceCollection
    {
        return PostResource::collection(
            $user->posts()->latest()->paginate($request->input('limit', 10))
        );
    }

     public function search_posts(Request $request): ResourceCollection
    {
        return PostResource::collection(
            Post::search($request->input('q'))->with('categories')->withCount('comments')->latest()->paginate($request->input('limit', 10))
        );
    }

     public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }
}
