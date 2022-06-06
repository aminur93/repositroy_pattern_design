<?php

namespace App\Listeners;

use App\Events\NewCustomerHasregisterEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisterCustomerToNewslatter
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
     * @param  NewCustomerHasregisterEvent  $event
     * @return void
     */
    public function handle(NewCustomerHasregisterEvent $event)
    {
        dump('Register for News latter');
    }
}
