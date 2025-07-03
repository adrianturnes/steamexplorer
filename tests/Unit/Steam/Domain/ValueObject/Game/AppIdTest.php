<?php

declare(strict_types=1);

namespace Tests\Unit\Steam\Domain\ValueObject\Game;

use App\Steam\Domain\ValueObject\Game\AppId;
use PHPUnit\Framework\TestCase;

class AppIdTest extends TestCase
{
    const APP_ID = 123456;

    public function testAppId(): void
    {
        $appId = AppId::fromInt(self::APP_ID);

        $this->assertInstanceOf(AppId::class, $appId);
        $this->assertSame(self::APP_ID, $appId->value());
    }
}
