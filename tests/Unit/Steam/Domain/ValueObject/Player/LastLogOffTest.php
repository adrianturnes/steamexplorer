<?php

namespace Tests\Unit\Steam\Domain\ValueObject\Player;

use App\Steam\Domain\ValueObject\Player\LastLogOff;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class LastLogOffTest extends TestCase
{
    const LAST_LOG_OFF = 1672531200;
    public function testLastLogOffVO(): void
    {
        $lastLogOff = LastLogOff::fromInt(self::LAST_LOG_OFF);

        $this->assertInstanceOf(Carbon::class, $lastLogOff->value());
        $this->assertEquals(self::LAST_LOG_OFF, $lastLogOff->value()->timestamp);
    }
}
