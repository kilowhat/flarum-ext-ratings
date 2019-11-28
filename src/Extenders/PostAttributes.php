<?php

namespace Kilowhat\Ratings\Extenders;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\PostSerializer;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class PostAttributes implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(Serializing::class, [$this, 'serializing']);
    }

    public function serializing(Serializing $event)
    {
        if ($event->isSerializer(PostSerializer::class) && $event->actor->hasPermission('kilowhatRatings.view')) {
            $event->attributes['kilowhatRating'] = $event->model->kilowhat_rating;
            $event->attributes['kilowhatRatingCanEdit'] = $event->actor->can('kilowhatRatingEdit', $event->model);
        }
    }
}
