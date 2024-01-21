<?php

namespace Communication;

class Response
{
    public readonly ResponseStatus $code;
    private $data;

    public function __construct(ResponseStatus $code, $data = [])
    {
        $this->code = $code;
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function toJson(): string
    {
        return json_encode([
            'status' => $this->code,
            'data' => $this->data
        ], JSON_PRETTY_PRINT);
    }
}