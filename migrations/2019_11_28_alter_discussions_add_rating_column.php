<?php

use Flarum\Database\Migration;

return Migration::addColumns('discussions', [
    'kilowhat_rating' => ['tinyinteger', 'nullable' => true],
]);
