<?php

declare(strict_types=1);

namespace App\Steam\Infrastructure\Service;

use App\Steam\Domain\Entity\Player;
use App\Steam\Domain\Repository\GamePlayerRepository;
use App\Steam\Domain\Repository\PlayerRepository;
use App\Steam\Domain\Service\GamePlayerService as IGamePlayerService;

class GamePlayerService implements IGamePlayerService
{
    public function __construct(
        private readonly GamePlayerRepository $gamePlayerRepository,
        private readonly PlayerRepository $playerRepository,
    )
    {
    }

    public function getPlayerWithGames(string $steamId): Player
    {
        $player = $this->playerRepository->findOrFailBySteamId($steamId);
        $games = $this->gamePlayerRepository->findGamesByPlayerId($player->playerId());

        $player->setGames($games);

        return $player;
    }
}
