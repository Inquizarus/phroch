<?php
namespace Botty;

use Botty\Data\LogEntry;

class Logger implements LoggerInterface
{
    const ENTRY_TYPE_ERROR = 'error';
    const ENTRY_TYPE_INFO  = 'info';

    /** @var LogEntry[] */
    private $entries = [];

    /**
     * @inheritDoc
     */
    public function log(string $type, string $message): LoggerInterface
    {
        $entry = new LogEntry();
        $entry->type = (string) $type;
        $entry->message = (string) $message;
        $entry->timestamp = (int) time();
        $this->entries[] = $entry;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function info(string $message): LoggerInterface
    {
        return $this->log(self::ENTRY_TYPE_INFO, $message);
    }

    /**
     * @inheritDoc
     */
    public function error(string $message): LoggerInterface
    {
        return $this->log(self::ENTRY_TYPE_ERROR, $message);
    }

    /**
     * @inheritDoc
     */
    public function getLogEntries(): array
    {
        return $this->entries;
    }

}