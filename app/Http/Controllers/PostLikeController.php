<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Transformers\PostTransformer;
use App\Events\PostLikeCreated;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function store(Request $request,Post $post)
    {
        $this->authorize('like',$post);

        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        broadcast(new PostLikeCreated($post))->toOthers();

        return fractal()
                    ->item($post->fresh())
                    ->transformWith(new PostTransformer)
                    ->toArray();
    }
}
