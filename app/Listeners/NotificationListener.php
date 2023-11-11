<?php

namespace App\Listeners;

use App\Events\NotificationEvent;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationListener
{

    /**
     * Handle the event.
     *
     * @param  \App\Events\NotificationEvent  $event
     * @return string
     */
    public function handle(NotificationEvent $event): string
    {
        $notificationService = new NotificationService();

        return $notificationService->notifyUser($event->user)->content();
    }
}
