<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Post;

class PostUserTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'owner',
        'liked',
        'likesRemaining'
    ];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Post $post)
    {
        return [
           
        ];
    }

    public function includeOwner(Post $post)
    {
        return $this->primitive($post,function($post){
            return optional(auth()->user())->id === $post->user_id;
        });
    }

    public function includeLiked(Post $post)
    {
        return $this->primitive($post,function($post){
            if(!$user = auth()->user())
            {
                return false;
            }
            return $post->likers->contains($user);
        });
    }

    public function includeLikesRemaining(Post $post)
    {
        return $this->primitive($post,function($post){
            if(!$user = auth()->user())
            {
                return false;
            }
            return $post->likesRemainingFor($user);
        });
    }


}
