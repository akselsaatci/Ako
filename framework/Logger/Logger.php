<?php

namespace Framework\Logger;

use Framework\Logger\Handlers\LogHandlerInterface;
use Psr\Log\LoggerInterface;

/** @package Framework\Logger */
class Logger implements LoggerInterface
{
    private readonly LogHandlerInterface $dispatcher;

    /**
     * @param LogHandlerInterface $dipstacher 
     * @return void 
     */
    public function __construct(LogHandlerInterface $dipstacher)
    {
        //TODO: Maybe different channels for different log levels?
        $this->dispatcher = $dipstacher;
    }

    /**
     * @param mixed $message 
     * @param mixed[] $context 
     * @return void 
     */
    public function emergency($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("EMERGENCTY", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    /**
     * @param mixed $message 
     * @param mixed[] $context 
     * @return void 
     */
    public function alert($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("ALERT", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    /**
     * @param mixed $message 
     * @param mixed[] $context 
     * @return void 
     */
    public function critical($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("CRITICAL", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }


    /**
     * @param mixed $message 
     * @param mixed[] $context 
     * @return void 
     */
    public function error($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("ERROR", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    /**
     * @param mixed $message 
     * @param mixed[] $context 
     * @return void 
     */
    public function warning($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("WARNING", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    /**
     * @param mixed $message 
     * @param mixed[] $context 
     * @return void 
     */
    public function notice($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("NOTICE", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    /**
     * @param mixed $message 
     * @param mixed[] $context 
     * @return void 
     */
    public function info($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("INFO", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    /**
     * @param mixed $message 
     * @param mixed[] $context 
     * @return void 
     */
    public function debug($message, array $context = []): void
    {
        $formattedMessage = $this->formatMessage("DEBUG", $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }

    /**
     * @param mixed $level 
     * @param mixed $message 
     * @param mixed[] $context 
     * @return void 
     */
    public function log($level, $message, array $context = []): void
    {
        //TODO : Here check the level if its valid 
        $formattedMessage = $this->formatMessage($level, $message, $context);

        $this->dispatcher->handleLog($formattedMessage);
    }


    //From psr-3

    /**
     * @param string $message 
     * @param array $context 
     * @return string 
     */
    private function interpolate(string $message, array $context = array()): string
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
     * @param string $level 
     * @param string $message 
     * @param array $context 
     * @return string 
     */
    private function formatMessage(string $level, string $message, array $context): string
    {
        //TODO: Add context to logging
        $message = $this->interpolate($message, $context);
        $formattedMessage = sprintf("[%s] : %s \n", $level, $message);

        return $formattedMessage;
    }
}
