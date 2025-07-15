<?php

namespace Integration\Infrastructure\Service\Steam;

use App\Shared\Domain\Event\EventBus;
use App\Steam\Domain\Event\PlayerCreatedEvent;
use App\Steam\Domain\Exception\PlayerAlreadyExistsException;
use App\Steam\Domain\Repository\PlayerRepository;
use Database\Seeders\PlayerSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CreatePlayerListenerTest extends TestCase
{
    use DatabaseTransactions;

    /** @var EventBus */
    private mixed $eventBus;
    /** @var PlayerRepository */
    private mixed $playerRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->eventBus = resolve(EventBus::class);
        $this->playerRepository = resolve(PlayerRepository::class);
    }

    public function test_create_player_listener(): void
    {
        $player = $this->playerRepository->findBySteamId(PlayerSeeder::TEST_PLAYER_1_STEAM_ID);
        $event = new PlayerCreatedEvent($player);
        $this->eventBus->publish([$event]);
        $this->eventBus->flush();
        $games = DB::table('game_player')->where('player_id', '=', $player->playerId()->value())->get();
        $this->assertCount(6, $games);
    }

}
