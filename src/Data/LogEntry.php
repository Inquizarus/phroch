<?php
namespace Botty\Data;

class LogEntry
{
    /** @var string */
    public $type = null;

    /** @var string */
    public $message = null;

    /** @var int */
    public $timestamp = null;

    /**
     * @return string
     */
    public function __toString()
    {
        $format = '%s [%s]: %s';
        return sprintf($format, $this->timestamp, $this->type, $this->message);
    }
}