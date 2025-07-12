<?php

namespace Tests\Unit\Shared\Domain\ValueObject;

use App\Shared\Domain\ValueObject\TypedCollection;
use PHPUnit\Framework\TestCase;

class TypedCollectionTest extends TestCase
{
    public function testAddItemToCollection(): void
    {
        $collection = new class extends TypedCollection {
            protected function type(): string
            {
                return \stdClass::class;
            }
        };

        $item = new \stdClass();
        $collection->add($item);

        $this->assertCount(1, $collection);
        $this->assertSame($item, $collection->first());
    }

    public function testAddInvalidItemToCollection(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('TypedCollection only accepts instances of stdClass.');

        $collection = new class extends TypedCollection {
            protected function type(): string
            {
                return \stdClass::class;
            }
        };

        $collection->add(new \DateTime());
    }

    public function testPushMultipleItems(): void
    {
        $collection = new class extends TypedCollection {
            protected function type(): string
            {
                return \stdClass::class;
            }
        };

        $item1 = new \stdClass();
        $item2 = new \stdClass();
        $collection->push($item1, $item2);

        $this->assertCount(2, $collection);
        $this->assertSame($item1, $collection->get(0));
        $this->assertSame($item2, $collection->get(1));
    }

}
