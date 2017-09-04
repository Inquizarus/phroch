<?php
namespace Botty\Test\Data;

use Botty\Data\LogEntry;
use Botty\Logger;
use PHPUnit\Framework\TestCase;

class LogEntryTest extends TestCase
{
    public function testItStringyfiesCorrectly()
    {
        $entry = new LogEntry();
        $entry->message = 'test';
        $entry->type = Logger::ENTRY_TYPE_INFO;
        $entry->timestamp = 123;

        $expected = '123 [info]: test';
        $this->assertEquals($expected, (string) $entry);
    }
}