<?php

namespace Framework\Logger\Handlers;

use Framework\Logger\Handlers\LogHandlerInterface;

/** @package Framework\Logger\Handlers */
class FileLogHandler implements LogHandlerInterface
{

    private readonly string $logFileLocation;

    /**
     * @param string $logFileLocation 
     * @return void 
     */
    public function __construct(string $logFileLocation)
    {
        //WARN: Check the file is valid
        //TODO: Check the file is valid
        $this->logFileLocation = $logFileLocation;
    }

    /**
     * @param string $message 
     * @return void 
     */
    public function handleLog(string $message): void
    {
        file_put_contents($this->logFileLocation, $message,FILE_APPEND);
    }
}
