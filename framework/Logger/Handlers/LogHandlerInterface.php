<?php

namespace Framework\Logger\Handlers;

/** @package Framework\Logger\Handlers */
interface LogHandlerInterface
{
    /**
     * @param string $message 
     * @return void 
     */
    public function handleLog(string $message): void;
}
