<?php
namespace Botty;

interface LoggerInterface
{
    /**
     * @param string $type
     * @param string $message
     *
     * @return LoggerInterface
     */
    public function log(string $type, string $message): LoggerInterface;

    /**
     * @param string $message
     *
     * @return LoggerInterface
     */
    public function info(string $message): LoggerInterface;

    /**
     * @param string $message
     *
     * @return LoggerInterface
     */
    public function error(string $message): LoggerInterface;

    /**
     * @return array
     */
    public function getLogEntries(): array;
}