<?php

namespace App\Listeners;

use App\Events\DataSynchronized;
use Illuminate\Support\Facades\Log;

class LogSynchronizations
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DataSynchronized  $event
     * @return void
     */
    public function handle(DataSynchronized $event)
    {
        Log::channel('datasync')->info('Database is synchronized with these data: ', $event->capsules);
    }
}
