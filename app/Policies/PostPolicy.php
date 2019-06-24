<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Post;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function like(User $user,Post $post)
    {
        
        if($user->id == $post->user_id)
        {
            return false;
        }

        if($post->maxLikesReachedFor($user))
        {
            return false;
        }

        return true;
    }

    
}
