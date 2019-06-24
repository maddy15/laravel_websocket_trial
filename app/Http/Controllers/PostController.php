<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Transformers\PostTransformer;
use App\Http\Requests\PostStoreRequest;
use App\Events\PostCreated;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $posts = Post::latest()->get();

        return fractal()
                    ->collection($posts)
                    ->transformWith(new PostTransformer)
                    ->toArray();
    }

    public function show(Post $post)
    {

        return fractal()
                    ->item($post)
                    ->transformWith(new PostTransformer)
                    ->toArray();
    }


    public function store(PostStoreRequest $request)
    {
        $post = $request->user()->posts()->create(
            $request->only(['body'])
        );

        broadcast(new PostCreated($post))->toOthers();

        return fractal()
                    ->item($post)
                    ->transformWith(new PostTransformer)
                    ->toArray();
    }
}
