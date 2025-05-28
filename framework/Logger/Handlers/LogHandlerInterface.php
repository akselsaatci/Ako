<?php

namespace Framework\Logger\Handlers;

interface LogHandlerInterface
{
    public function handleLog(string $message): void;
}
