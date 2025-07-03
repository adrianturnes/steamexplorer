<?php

namespace Tests\Unit\Steam\Domain\ValueObject\Player;

use App\Steam\Domain\ValueObject\Player\Avatar;
use PHPUnit\Framework\TestCase;

class AvatarTest extends TestCase
{
    private const AVATAR_URL = 'http://example.com/avatar.jpg';
    public function testAvatarVO(): void
    {
        $avatar = Avatar::fromString(self::AVATAR_URL);

        $this->assertEquals(self::AVATAR_URL, $avatar->value());
    }
}
