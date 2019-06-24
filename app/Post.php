<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const MAX_LIKES = 5;

    protected $fillable = ['user_id','body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class,'likeable');
    }

    public function likers()
    {
        return $this->hasManyThrough(
            User::class,Like::class,'likeable_id','id','id','user_id'
        )
        ->where('likeable_type',Post::class)
        ->groupBy('likes.user_id','users.id','users.name','users.email','users.email_verified_at','users.password','users.remember_token','users.created_at','users.updated_at','likes.likeable_id');
    }

    public function likesRemainingFor(User $user)
    {
        return static::MAX_LIKES - $this->likes->where('user_id',$user->id)->count();
    }

    public function maxLikesReachedFor(User $user)
    {
        return $this->likesRemainingFor($user) <= 0;
    }
}
