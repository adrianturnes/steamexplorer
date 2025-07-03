<?php

namespace Tests\Unit\Steam\Domain\ValueObject\Player;

use App\Steam\Domain\ValueObject\Player\PersonaName;
use PHPUnit\Framework\TestCase;

class PersonaNameTest extends TestCase
{
    const TEST_PERSONA_NAME = 'TestPersona';
    public function testPersonaNameVO(): void
    {
        $personaName = PersonaName::fromString(self::TEST_PERSONA_NAME);

        $this->assertEquals(self::TEST_PERSONA_NAME, $personaName->value());
    }
}
