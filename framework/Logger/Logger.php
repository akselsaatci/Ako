<?php

namespace Framework\Logger;

use Framework\Logger\Handlers\LogHandlerInterface;
use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface
{
    private readonly LogHandlerInterface $dispatcher;

    public function __construct(LogHandlerInterface $dipstacher)
    {
        //TODO: Maybe different channels for different log levels?
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


    //From psr-3

    /**
     * Interpolates context values into the message placeholders.
     * @param array<int,mixed> $context
     */
    private   function interpolate(string $message, array $context = array()): string
    {
        // build a replacement array with braces around the context keys
        $replace = array();
        foreach ($context as $key => $val) {
            // check that the value can be cast to string
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }

        // interpolate replacement values into the message and return
        return strtr($message, $replace);
    }
    /**
     * @param array<int,mixed> $context
     */
    private function  formatMessage(string $level, string $message, array $context): string
    {
        //TODO: Add context to logging
        $message = $this->interpolate($message, $context);
        $formattedMessage = sprintf("[%s] : %s \n", $level, $message);

        return $formattedMessage;
    }
}
