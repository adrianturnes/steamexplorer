<?php

namespace App\Shared\Infrastructure\Event;

use App\Shared\Domain\Event\EventBus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class AsyncEventBus implements EventBus
{
    public function __construct(private array $events = [])
    {
    }

    public function publish(array $events): void
    {
        foreach ($events as $event) {
            $this->events[] = $event;
        }
    }

    public function flush(): void
    {
        foreach ($this->events as $event) {
            Log::info('Dispatching event: ' . get_class($event));
            AsyncEventJob::dispatch($event);
        }
    }
}
