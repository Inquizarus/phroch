<?php
namespace Botty\Test\Command;

use Botty\Command\TurnRightCommand;
use PHPUnit\Framework\TestCase;

class TurnRightCommandTest extends TestCase
{
    /**
     * @test
     */
    public function testItReturnsTheCorrectType()
    {
        $command = new TurnRightCommand();
        $this->assertEquals(TurnRightCommand::COMMAND_TURN_RIGHT, $command->getType());
    }
}