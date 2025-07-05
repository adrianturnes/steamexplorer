<?php

namespace App\Steam\Application\Command;

use App\Shared\Application\Command\CommandHandler;
use App\Shared\Domain\Event\EventBus;
use App\Steam\Domain\Entity\Player;
use App\Steam\Domain\Exception\PlayerAlreadyExistsException;
use App\Steam\Domain\Repository\PlayerRepository;
use App\Steam\Domain\Service\Steam\SteamUserService;
use App\Steam\Domain\ValueObject\Player\Avatar;
use App\Steam\Domain\ValueObject\Player\CommunityVisibilityState;
use App\Steam\Domain\ValueObject\Player\LastLogOff;
use App\Steam\Domain\ValueObject\Player\PersonaName;
use App\Steam\Domain\ValueObject\Player\ProfileUrl;
use App\Steam\Domain\ValueObject\Player\SteamId;
use App\Steam\Domain\ValueObject\Player\TimeCreated;

class CreatePlayerCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly SteamUserService $steamUserService,
        private readonly PlayerRepository $playerRepository,
        private readonly EventBus $eventBus
    ) {}

    public function handle(CreatePlayerCommand $command): void
    {
        $steamId = $this->steamUserService->getSteamId($command->getUserName());
        $steamUser = $this->steamUserService->getSteamName($steamId);

        $player = $this->playerRepository->findBySteamId($steamId);

        if($player) {
            throw new PlayerAlreadyExistsException($command->getUserName());
        }

        $player = $this->createPlayer($steamId, $steamUser);

        $this->playerRepository->save($player);

        $this->eventBus->publish($player->events());
        $this->eventBus->flush();
    }

    private function createPlayer(string $steamId, array $steamUser): Player
    {
        return Player::create(
            SteamId::fromString($steamId),
            PersonaName::fromString($steamUser['personaname']),
            ProfileUrl::fromString($steamUser['profileurl']),
            Avatar::fromString($steamUser['avatar']),
            LastLogOff::fromInt($steamUser['lastlogoff']),
            TimeCreated::fromInt($steamUser['timecreated']),
            CommunityVisibilityState::fromInt($steamUser['communityvisibilitystate'])
        );
    }
}
