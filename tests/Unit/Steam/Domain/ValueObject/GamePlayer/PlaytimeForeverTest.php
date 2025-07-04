<?php

declare(strict_types=1);

namespace Tests\Unit\Steam\Domain\ValueObject\GamePlayer;

use App\Steam\Domain\ValueObject\GamePlayer\PlaytimeForever;
use PHPUnit\Framework\TestCase;

class PlaytimeForeverTest extends TestCase
{
    public function testPlaytimeForever(): void
    {
        $playtime = 12345;
        $playtimeForever = PlaytimeForever::fromInt($playtime);

        $this->assertInstanceOf(PlaytimeForever::class, $playtimeForever);
        $this->assertSame($playtime, $playtimeForever->value());
    }
}
