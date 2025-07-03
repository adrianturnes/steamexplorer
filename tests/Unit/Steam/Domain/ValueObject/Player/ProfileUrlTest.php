<?php

namespace Tests\Unit\Steam\Domain\ValueObject\Player;

use App\Steam\Domain\ValueObject\Player\ProfileUrl;
use PHPUnit\Framework\TestCase;

class ProfileUrlTest extends TestCase
{
    const PROFILE_URL = 'http://example.com/profile/TestPersona';

    public function testProfileUrl(): void
    {
        $profileUrl = ProfileUrl::fromString(self::PROFILE_URL);

        $this->assertEquals(self::PROFILE_URL, $profileUrl->value());
    }
}
