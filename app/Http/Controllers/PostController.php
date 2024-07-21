<?php

namespace App\Http\Controllers;

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
}
