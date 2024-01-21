<?php

namespace Communication;
class Request
{
    public readonly string $url;
    public readonly array $data;

    public function __construct(string $url, array $data)
    {
        $this->url = $url;
        $this->data = $data;
    }
}