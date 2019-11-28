<?php

namespace Kilowhat\Ratings\Extenders;

use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\Post\Event\Saving;
use Flarum\User\AssertPermissionTrait;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Arr;
use Illuminate\Support\Optional;
use Kilowhat\Ratings\Validators\RatingValidator;

class SaveRating implements ExtenderInterface
{
    use AssertPermissionTrait;

    public function extend(Container $container, Extension $extension = null)
    {
        $container['events']->listen(Saving::class, [$this, 'saving']);
    }

    public function saving(Saving $event)
    {
        $attributes = Arr::get($event->data, 'attributes', []);

        if (array_key_exists('kilowhatRating', $attributes)) {
            $this->assertCan($event->actor, 'kilowhatRatingEdit', $event->post);

            /**
             * @var $validator RatingValidator
             */
            $validator = app(RatingValidator::class);

            $validator->assertValid([
                'rating' => $attributes['kilowhatRating'],
            ]);

            $event->post->kilowhat_rating = $attributes['kilowhatRating'];

            $event->post->afterSave(function () use ($event) {
                $averageRating = (new Optional($event->post->discussion->comments()
                    ->selectRaw('AVG(kilowhat_rating) as avg')
                    ->whereNotNull('kilowhat_rating')
                    ->first()))->avg;

                $event->post->discussion->kilowhat_rating = round($averageRating * 2); // Save the value on 10 so we keep half-ratings but save as integer
                $event->post->discussion->save();
            });
        }
    }
}
