<?php

namespace Tests\Unit\Steam\Domain\ValueObject\Player;

use App\Steam\Domain\ValueObject\Player\TimeCreated;
use PHPUnit\Framework\TestCase;

class TimeCreatedTest extends TestCase
{
    public function testTimeCreatedWithNullValue(): void
    {
        $timeCreatedVO = TimeCreated::fromInt(null);

        $this->assertNull($timeCreatedVO->value());
    }

    public function testTimeCreatedWithIntValue(): void
    {
        $timestamp = 1633072800;
        $timeCreatedVO = TimeCreated::fromInt($timestamp);

        $this->assertEquals($timestamp, $timeCreatedVO->value()->timestamp);
    }
}
