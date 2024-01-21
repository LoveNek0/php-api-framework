<?php

namespace Handlers;

use Attributes\Handler;
use Attributes\Method;
use Communication\Request;
use Communication\Response;
use Communication\ResponseStatus;

#[Handler("users")]
class Users
{
    #[Method("get")]
    public static function get(Request $request): Response
    {
        $data = "Hello world!";
        return new Response(ResponseStatus::Success, [$data]);
    }
}