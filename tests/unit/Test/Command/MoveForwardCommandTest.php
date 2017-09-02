<?php
namespace Botty\Test\Command;

use Botty\Command\MoveForwardCommand;
use PHPUnit\Framework\TestCase;

class MoveForwardCommandTest extends TestCase
{
    /**
     * @test
     */
    public function testItReturnsTheCorrectType()
    {
        $command = new MoveForwardCommand();
        $this->assertEquals(MoveForwardCommand::COMMAND_MOVE_FORWARD, $command->getType());
    }
}