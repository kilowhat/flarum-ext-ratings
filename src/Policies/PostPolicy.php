<?php

namespace Kilowhat\Ratings\Policies;

use Flarum\Post\Post;
use Flarum\User\AbstractPolicy;
use Flarum\User\User;

class PostPolicy extends AbstractPolicy
{
    protected $model = Post::class;

    public function kilowhatRatingEdit(User $actor, Post $post)
    {
        return ($actor->id === $post->user_id && $actor->hasPermission('kilowhatRatings.submit')) || $actor->hasPermission('kilowhatRatings.moderate');
    }
}
