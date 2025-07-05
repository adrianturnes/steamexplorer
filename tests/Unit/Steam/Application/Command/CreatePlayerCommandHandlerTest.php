<?php

declare(strict_types=1);

namespace Tests\Unit\Steam\Application\Command;

use App\Shared\Domain\Event\EventBus;
use App\Steam\Application\Command\CreatePlayerCommand;
use App\Steam\Application\Command\CreatePlayerCommandHandler;
use App\Steam\Domain\Entity\Player;
use App\Steam\Domain\Exception\PlayerAlreadyExistsException;
use App\Steam\Domain\Repository\PlayerRepository;
use App\Steam\Domain\Service\Steam\SteamUserService;
use PHPUnit\Framework\TestCase;

class CreatePlayerCommandHandlerTest extends TestCase
{
    public function testCreatePlayerWithAlreadyExistingPlayer(): void
    {
        $steamUserService = $this->createMock(SteamUserService::class);
        $steamUserService->method('getSteamId')->willReturn('123456');

        $playerRepository = $this->createMock(PlayerRepository::class);
        $playerRepository->method('findBySteamId')->willReturn($this->createMock(Player::class));

        $eventBus = $this->createMock(EventBus::class);

        $command = new CreatePlayerCommand('PLAYER');
        $handler = new CreatePlayerCommandHandler($steamUserService, $playerRepository, $eventBus);

        $this->expectException(PlayerAlreadyExistsException::class);
        $handler->handle($command);

    }
}
