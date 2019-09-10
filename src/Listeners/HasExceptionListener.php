<?php

namespace Phambinh\Laraexcepnotify\Listeners;

use Phambinh\Laraexcepnotify\Events\HasExceptionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Phambinh\Laraexcepnotify\Facades\ExceptionNotify;
use Phambinh\Laraexcepnotify\Notifications\HasExceptionNotification;
use Phambinh\Laraexcepnotify\Exceptions\QuietException;

class HasExceptionListener
{
    public function handle(HasExceptionEvent $event)
    {
        if (config('notification.lara_exception_notify.enable')) {
            if (!$event->exception instanceof QuietException) {
                $notify = new HasExceptionNotification($event);
                ExceptionNotify::send($notify);
            }
        }
    }
}
