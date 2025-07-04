<?php

declare(strict_types=1);

namespace App\Steam\Domain\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Steam\Domain\Entity\GamePlayer;
use Carbon\Carbon;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GamePlayerCreatedEvent implements DomainEvent
{
    use Dispatchable, SerializesModels;

    private int $occurredOn;

    public function __construct(private GamePlayer $gamePlayer)
    {
        $this->occurredOn = Carbon::now()->getTimestamp();
    }

    public function occurredOn(): int
    {
        return $this->occurredOn;
    }

    public function gamePlayer(): GamePlayer
    {
        return $this->gamePlayer;
    }
}
