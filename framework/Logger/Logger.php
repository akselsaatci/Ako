<?php

namespace Framework\Logger;

use Framework\Logger\Handlers\LogHandlerInterface;
use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface
{
    private readonly LogHandlerInterface $dispatcher;

    public function __construct(LogHandlerInterface $dipstacher)
    {
        $this->dispatcher = $dipstacher;
    }

    public function emergency($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("EMERGENCTY", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    public function alert($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("ALERT", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    public function critical($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("CRITICAL", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }


    public function error($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("ERROR", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    public function warning($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("WARNING", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    public function notice($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("NOTICE", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    public function info($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("INFO", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    public function debug($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("DEBUG", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    public function log($level, $message, array $context = []): void
    {
        //TODO : Here check the level if its valid 
        $formattedMessage = $this->formatMessage($level, $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }


    private function  formatMessage(string $level, string $message, mixed $context): string
    {
        $formattedMessage = sprintf("[%s] : %s \nContext : %s \n", $level, $message, implode(' ',$context));

        return $formattedMessage;
    }
}
