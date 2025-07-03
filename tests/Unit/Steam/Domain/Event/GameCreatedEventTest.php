<?php

declare(strict_types=1);

namespace Tests\Unit\Steam\Domain\Event;

use App\Steam\Domain\Entity\Game;
use App\Steam\Domain\Event\GameCreatedEvent;
use App\Steam\Domain\ValueObject\Game\AppId;
use App\Steam\Domain\ValueObject\Game\ImgIconUrl;
use App\Steam\Domain\ValueObject\Game\Name;
use PHPUnit\Framework\TestCase;

class GameCreatedEventTest extends TestCase
{
    public function testGameCreation(): void
    {
        $appId = AppId::fromInt(123456);
        $name = Name::fromString('Test Game');
        $imgIconUrl = ImgIconUrl::fromString('https://example.com/icon.png');

        $game = Game::create($appId, $name, $imgIconUrl);
        $event = new GameCreatedEvent($game);

        $this->assertIsInt($event->occurredOn());
        $this->assertEquals($game, $event->game());
    }
}
