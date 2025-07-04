<?php

declare(strict_types=1);

namespace Tests\Unit\Steam\Domain\ValueObject\GamePlayer;

use App\Steam\Domain\ValueObject\GamePlayer\TimeLastPlayed;
use PHPUnit\Framework\TestCase;

class TimeLastPlayedTest extends TestCase
{
    public function testTimeLastPlayed(): void
    {
        $timestamp = 1633072800; // Example timestamp
        $timeLastPlayed = TimeLastPlayed::fromInt($timestamp);

        $this->assertInstanceOf(TimeLastPlayed::class, $timeLastPlayed);
        $this->assertSame($timestamp, $timeLastPlayed->value()->timestamp);
    }

    public function testTimeLastPlayedWithNullValue(): void
    {
        $timeLastPlayed = TimeLastPlayed::fromInt(null);

        $this->assertInstanceOf(TimeLastPlayed::class, $timeLastPlayed);
        $this->assertNull($timeLastPlayed->value());
    }
}
