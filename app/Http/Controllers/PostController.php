<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        return inertia()->render("Posts/Index", [
            "posts" => PostResource::collection($posts),
        ]);
    }

    public function store(StorePostRequest $request)
    {
        sleep(5);

        auth()->user()->posts()->create($request->validated());

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

}
