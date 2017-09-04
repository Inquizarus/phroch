<?php
namespace Botty\Test\Factory;

use Botty\Command\MoveBackwardsCommand;
use Botty\Command\MoveForwardCommand;
use Botty\Command\TurnLeftCommand;
use Botty\Command\TurnRightCommand;
use Botty\Factory\CommandFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class CommandFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function testItMakesCommandsFromRequest()
    {
        $factory = new CommandFactory();
        $request = new Request([
            'commands' => 'lrfbq'
        ]);
        $commands = $factory->makeCommandsFromRequest($request);
        $this->assertEquals(4, count($commands));
        $this->assertInstanceOf(TurnLeftCommand::class, $commands[0]);
        $this->assertInstanceOf(TurnRightCommand::class, $commands[1]);
        $this->assertInstanceOf(MoveForwardCommand::class, $commands[2]);
        $this->assertInstanceOf(MoveBackwardsCommand::class, $commands[3]);
    }
}