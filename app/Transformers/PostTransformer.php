<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Post;

class PostTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'author','likers'
    ];

    public function transform(Post $post)
    {
        return [
            'id' => $post->id,
            'body' => $post->body,
            'likes' => $post->likes->count(),
            
        ];
    }

    public function includeAuthor(Post $post)
    {
        return $this->item($post,new PostUserTransformer);
    }

    public function includeLikers(Post $post)
    {
        return $this->collection($post->likers,new UserTransformer);
    }
}
