<?php

namespace App\Listeners;

use App\Events\DecidedCorrectnessOfMaterial;
use App\Jobs\DecideCorrectnessOfMaterial;

class MaterialListener
{
    /**
     * Handle the event.
     *
     * @param DecidedCorrectnessOfMaterial $event
     * @return void
     */
    public function handleDecidedCorrectness(DecidedCorrectnessOfMaterial $event)
    {
        DecideCorrectnessOfMaterial::dispatch($event->material)
            ->delay(now()->addSeconds(1));
    }

    public function shouldDiscoverEvents()
    {
        return true;
    }
}
