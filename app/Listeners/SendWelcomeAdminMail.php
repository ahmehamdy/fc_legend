<?php

namespace App\Listeners;

use App\Events\AdminCreated;
use App\Mail\WelcomeAdminMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeAdminMail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AdminCreated $event): void
    {
        Mail::to($event->user->email)->queue(new WelcomeAdminMail($event->user));
    }
}
