<?php

declare(strict_types=1);

namespace App\Steam\Domain\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Steam\Domain\Entity\Game;
use Carbon\Carbon;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GameCreatedEvent implements DomainEvent
{
    use Dispatchable, SerializesModels;

    private int $occurredOn;

    public function __construct(private Game $game)
    {
        $this->occurredOn = Carbon::now()->getTimestamp();
    }

    public function occurredOn(): int
    {
        return $this->occurredOn;
    }

    public function game(): Game
    {
        return $this->game;
    }
}
