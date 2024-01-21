<?php

namespace Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Method
{
    public readonly string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
