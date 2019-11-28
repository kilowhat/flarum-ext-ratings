<?php

namespace Kilowhat\Ratings\Extenders;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class DiscussionAttributes implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(Serializing::class, [$this, 'serializing']);
    }

    public function serializing(Serializing $event)
    {
        if ($event->isSerializer(DiscussionSerializer::class) && $event->actor->hasPermission('kilowhatRatings.view')) {
            $event->attributes['kilowhatRating'] = $event->model->kilowhat_rating / 2; // Transform rating on 10 to rating on 5
        }
    }
}
