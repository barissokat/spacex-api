<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DataSynchronized
{
    use Dispatchable, SerializesModels;

    public $capsules;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($capsules)
    {
        $this->capsules = $capsules;
    }

    /**
     * Get the subject of the event.
     */
    public function subject()
    {
        return $this->capsules;
    }
}
