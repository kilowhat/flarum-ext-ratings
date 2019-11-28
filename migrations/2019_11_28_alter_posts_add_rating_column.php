<?php

use Flarum\Database\Migration;

return Migration::addColumns('posts', [
    'kilowhat_rating' => ['tinyinteger', 'nullable' => true],
]);
