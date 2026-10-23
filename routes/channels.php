<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('fixture.{fixtureId}', function ($user, $fixtureId) {
    return true;
});
