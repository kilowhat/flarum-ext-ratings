<?php

namespace Kilowhat\Ratings;

use Flarum\Extend;
use Illuminate\Contracts\Events\Dispatcher;
use Kilowhat\Ratings\Policies\PostPolicy;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),
    new Extend\Locales(__DIR__ . '/resources/locale'),

    new Extenders\DiscussionAttributes(),
    new Extenders\ForumAttributes(),
    new Extenders\PostAttributes(),
    new Extenders\SaveRating(),

    function (Dispatcher $events) {
        $events->subscribe(PostPolicy::class);
    },
];
