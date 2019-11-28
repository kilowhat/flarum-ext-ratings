<?php

namespace Kilowhat\Ratings\Validators;

use Flarum\Foundation\AbstractValidator;

class RatingValidator extends AbstractValidator
{
    protected $rules = [
        'rating' => 'nullable|integer|min:1|max:5',
    ];
}
