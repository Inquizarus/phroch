<?php
namespace Botty\Test\Command;

use Botty\Command\TurnLeftCommand;
use PHPUnit\Framework\TestCase;

class TurnLeftCommandTest extends TestCase
{
    /**
     * @test
     */
    public function testItReturnsTheCorrectType()
    {
        $command = new TurnLeftCommand();
        $this->assertEquals(TurnLeftCommand::COMMAND_TURN_LEFT, $command->getType());
    }
}