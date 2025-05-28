<?php

namespace Framework\Logger\Handlers;

use Framework\Logger\Handlers\LogHandlerInterface;

class FileLogHandler implements LogHandlerInterface
{

    private readonly string $logFileLocation;

    public function __construct(string $logFileLocation)
    {
        //WARN: Check the file is valid
        //TODO: Check the file is valid
        $this->logFileLocation = $logFileLocation;
    }

    public function handleLog(string $message): void
    {
        file_put_contents($this->logFileLocation, $message);
    }
}
