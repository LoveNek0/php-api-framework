<?php

namespace Attributes;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Handler
{
    public readonly string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
