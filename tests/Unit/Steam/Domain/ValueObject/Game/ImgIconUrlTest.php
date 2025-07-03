<?php

declare(strict_types=1);

namespace Tests\Unit\Steam\Domain\ValueObject\Game;

use App\Steam\Domain\ValueObject\Game\ImgIconUrl;
use PHPUnit\Framework\TestCase;

class ImgIconUrlTest extends TestCase
{
    const URL = 'https://example.com/icon.png';

    public function testImgIconUrl(): void
    {
        $imgIconUrl = ImgIconUrl::fromString(self::URL);
        $this->assertInstanceOf(ImgIconUrl::class, $imgIconUrl);
        $this->assertSame(self::URL, $imgIconUrl->value());
    }
}
