<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Event;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AsyncEventJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(private $event)
    {
    }

    public function handle()
    {
        event($this->event);
    }
}
