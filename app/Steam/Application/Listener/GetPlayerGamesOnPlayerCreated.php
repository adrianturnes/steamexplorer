<?php

declare(strict_types=1);

namespace App\Steam\Application\Listener;

use App\Steam\Application\Command\UpdatePlayerGamesCommand;
use App\Steam\Application\Command\UpdatePlayerGamesCommandHandler;
use App\Steam\Domain\Event\PlayerCreatedEvent;

class GetPlayerGamesOnPlayerCreated
{
    public function __construct(
        private readonly UpdatePlayerGamesCommandHandler $updatePlayerGamesCommandHandler
    )
    {
    }

    public function handle(PlayerCreatedEvent $event): void
    {
        $updatePlayerGamesCommand = new UpdatePlayerGamesCommand($event->player()->steamId()->value());
        $this->updatePlayerGamesCommandHandler->handle($updatePlayerGamesCommand);
    }
}
