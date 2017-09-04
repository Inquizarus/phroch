<?php
namespace Botty\Test;

use Botty\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    /**
     * @test
     */
    public function testItLogsEntries()
    {
        $logger = new Logger();
        $logger->info('infoEntry');
        $logger->error('errorEntry');

        $result = $logger->getLogEntries();

        $this->assertEquals(2, count($result));
        $this->assertEquals(Logger::ENTRY_TYPE_INFO, $result[0]->type);
        $this->assertEquals(Logger::ENTRY_TYPE_ERROR, $result[1]->type);
    }
}