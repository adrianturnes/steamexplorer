<?php

namespace App\Shared\Domain\ValueObject;

use Illuminate\Support\Collection;
use InvalidArgumentException;

abstract class TypedCollection extends Collection
{
    abstract protected function type(): string;

    public function __construct($items = [])
    {
        parent::__construct([]);

        foreach ($items as $item) {
            $this->add($item);
        }
    }

    public function add($item)
    {
        $expectedType = $this->type();

        if (!($item instanceof $expectedType)) {
            throw new InvalidArgumentException(
                "TypedCollection only accepts instances of {$expectedType}."
            );
        }

        $this->items[] = $item;

        return $this;
    }

    public function push(...$values)
    {
        foreach ($values as $value) {
            $this->add($value);
        }

        return $this;
    }
}
