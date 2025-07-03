<?php

declare(strict_types=1);

namespace App\Steam\Domain\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Steam\Domain\Entity\Player;
use Carbon\Carbon;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayerCreatedEvent implements DomainEvent
{
    use Dispatchable, SerializesModels;

    private int $occurredOn;

    public function __construct(private Player $player)
    {
        $this->occurredOn = Carbon::now()->getTimestamp();
    }

    public function occurredOn(): int
    {
        return $this->occurredOn;
    }

    public function player(): Player
    {
        return $this->player;
    }
}
