<?php
namespace Botty\Test\Command;

use Botty\Command\MoveBackwardsCommand;
use PHPUnit\Framework\TestCase;

class MoveBackwardsCommandTest extends TestCase
{
    /**
     * @test
     */
    public function testItReturnsTheCorrectType()
    {
        $command = new MoveBackwardsCommand();
        $this->assertEquals(MoveBackwardsCommand::COMMAND_MOVE_BACKWARDS, $command->getType());
    }
}