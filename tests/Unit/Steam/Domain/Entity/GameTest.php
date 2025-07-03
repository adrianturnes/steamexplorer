<?php

namespace Tests\Unit\Steam\Domain\Entity;

use App\Steam\Domain\Entity\Game;
use App\Steam\Domain\ValueObject\Game\AppId;
use App\Steam\Domain\ValueObject\Game\GameId;
use App\Steam\Domain\ValueObject\Game\ImgIconUrl;
use App\Steam\Domain\ValueObject\Game\Name;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testCreateGame(): void
    {
        $appId = AppId::fromInt(123456);
        $name = Name::fromString('Test Game');
        $imgIconUrl = ImgIconUrl::fromString('https://example.com/icon.png');

        $game = Game::create($appId, $name, $imgIconUrl);

        $this->assertInstanceOf(Game::class, $game);
        $this->assertInstanceOf(GameId::class, $game->gameId());
        $this->assertEquals($appId, $game->appId());
        $this->assertEquals($name, $game->name());
        $this->assertEquals($imgIconUrl, $game->imgIconUrl());
    }

    public function testCreateFromPrimitives(): void
    {
        $game = Game::fromPrimitives(
            '01JZ8TE5P4YGHR0RZP5EY7F6SA',
            123456,
            'Test Game',
            'https://example.com/icon.png',
            1700000000,
            1700000000
        );

        $this->assertInstanceOf(Game::class, $game);
        $this->assertEquals('01JZ8TE5P4YGHR0RZP5EY7F6SA', $game->gameId()->value()->toString());
        $this->assertEquals(123456, $game->appId()->value());
        $this->assertEquals('Test Game', $game->name()->value());
        $this->assertEquals('https://example.com/icon.png', $game->imgIconUrl()->value());
        $this->assertEquals(1700000000, $game->createdAt()->getTimestamp());
        $this->assertEquals(1700000000, $game->updatedAt()->getTimestamp());
    }

    public function testGameSetters(): void
    {
        $appId = AppId::fromInt(123456);
        $name = Name::fromString('Test Game');
        $imgIconUrl = ImgIconUrl::fromString('https://example.com/icon.png');

        $game = Game::create($appId, $name, $imgIconUrl);

        $newAppId = AppId::fromInt(654321);
        $newName = Name::fromString('Updated Game');
        $newImgIconUrl = ImgIconUrl::fromString('https://example.com/updated_icon.png');
        $newUpdatedAt = Carbon::now();

        $game->setAppId($newAppId);
        $game->setName($newName);
        $game->setImgIconUrl($newImgIconUrl);
        $game->setUpdatedAt($newUpdatedAt);

        $this->assertEquals($newAppId, $game->appId());
        $this->assertEquals($newName, $game->name());
        $this->assertEquals($newImgIconUrl, $game->imgIconUrl());
        $this->assertEquals($newUpdatedAt->timestamp, $game->updatedAt()->timestamp);
    }
}
