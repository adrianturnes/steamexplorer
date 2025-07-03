<?php

namespace Tests\Unit\Steam\Domain\ValueObject\Player;

use App\Steam\Domain\ValueObject\Player\CommunityVisibilityState;
use PHPUnit\Framework\TestCase;

class CommunityVisibilityStateTest extends TestCase
{
    private const COMMUNITY_VISIBILITY_STATE = 3;
    public function testCommunityVisibilityStateVO(): void
    {
        $communityVisibilityState = CommunityVisibilityState::fromInt(self::COMMUNITY_VISIBILITY_STATE);

        $this->assertEquals(self::COMMUNITY_VISIBILITY_STATE, $communityVisibilityState->value());
    }
}
