<?php

declare(strict_types=1);

namespace App\Steam\Application\Command;

use App\Shared\Application\Command\CommandHandler;
use App\Shared\Domain\Event\EventBus;
use App\Steam\Domain\Entity\Game;
use App\Steam\Domain\Entity\GamePlayer;
use App\Steam\Domain\Entity\Player;
use App\Steam\Domain\Exception\GameNotFoundException;
use App\Steam\Domain\Repository\GamePlayerRepository;
use App\Steam\Domain\Repository\GameRepository;
use App\Steam\Domain\ValueObject\Game\AppId;
use App\Steam\Domain\ValueObject\Game\GameCollection;
use App\Steam\Domain\ValueObject\Game\ImgIconUrl;
use App\Steam\Domain\ValueObject\Game\Name;
use App\Steam\Domain\ValueObject\GamePlayer\GamePlayerCollection;
use App\Steam\Domain\ValueObject\GamePlayer\PlaytimeForever;
use App\Steam\Domain\ValueObject\GamePlayer\TimeLastPlayed;
use App\Steam\Infrastructure\Service\GamePlayerService;
use App\Steam\Infrastructure\Service\Steam\SteamPlayerService;

class UpdatePlayerGamesCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly GamePlayerService $gamePlayerService,
        private readonly SteamPlayerService $steamPlayerService,
        private readonly GameRepository $gameRepository,
        private readonly GamePlayerRepository $gamePlayerRepository,
        private readonly EventBus $eventBus
    ) {}

    public function handle(UpdatePlayerGamesCommand $command): void
    {
        $player = $this->gamePlayerService->getPlayerWithGames($command->getSteamId());
        $steamGames = $this->steamPlayerService->getOwnedGames($player->steamId()->value());

        $gameCollection = new GameCollection();
        $gamePlayerCollection = new GamePlayerCollection();

        foreach ($steamGames as $steamGame) {
            $game = $this->getOrCreateGame($steamGame);
            $gameCollection->add($game);

            $gamePlayer = $this->getOrCreateGamePlayer($player, $game, $steamGame);
            $gamePlayerCollection->add($gamePlayer);
        }

        $this->gameRepository->saveAll($gameCollection);
        foreach ($gameCollection as $game) {
            $this->eventBus->publish($game->events());
        }

        $this->gamePlayerRepository->save($gamePlayerCollection);
        foreach ($gamePlayerCollection as $gamePlayer) {
            //TODO: GamePlayerCreatedEvent|GamePlayerUpdatedEvent
            $this->eventBus->publish($gamePlayer->events());
        }
        $this->eventBus->publish($player->events());
        $this->eventBus->flush();
    }

    private function createGamePlayerEntity(Game $game, Player $player, mixed $steamGame): GamePlayer
    {
        return GamePlayer::create(
            $player->playerId(),
            $game->gameId(),
            PlaytimeForever::fromInt($steamGame['playtime_forever']),
            TimeLastPlayed::fromInt($steamGame['rtime_last_played'] ?? null)
        );
    }

    private function updateGamePlayerEntity(GamePlayer $playerGame, mixed $steamGame): void
    {
        $playerGame->setPlaytimeForever(PlaytimeForever::fromInt($steamGame['playtime_forever']));
        $playerGame->setTimeLastPlayed(TimeLastPlayed::fromInt($steamGame['rtime_last_played']));
    }

    private function getOrCreateGame(array $steamGame): Game
    {
        try {
            return $this->gameRepository->findOrFailByAppId($steamGame['appid']);
        } catch (GameNotFoundException $e) {
            return Game::create(
                AppId::fromInt($steamGame['appid']),
                Name::fromString($steamGame['name']),
                ImgIconUrl::fromString($steamGame['img_icon_url']),
            );
        }
    }

    private function getOrCreateGamePlayer(Player $player, Game $game, array $steamGame): GamePlayer
    {
        $existingGamePlayer = $player->games()->filter(function (GamePlayer $playerGame) use ($game) {
            return $playerGame->gameId()->value()->equals($game->gameId()->value());
        })->first();

        if (!$existingGamePlayer) {
            return $this->createGamePlayerEntity($game, $player, $steamGame);
        }

        $this->updateGamePlayerEntity($existingGamePlayer, $steamGame);
        return $existingGamePlayer;
    }
}
