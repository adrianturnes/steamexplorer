<?php

declare(strict_types=1);

namespace Tests\Unit\Steam\Domain\ValueObject\Game;

use App\Steam\Domain\ValueObject\Game\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    const NAME = 'Test Game Name';

    public function testName(): void
    {
        $name = Name::fromString(self::NAME);
        $this->assertInstanceOf(Name::class, $name);
        $this->assertSame(self::NAME, $name->value());
    }
}
