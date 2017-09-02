<?php
namespace Botty\Test\Robot;

use Botty\Command\MoveBackwardsCommand;
use Botty\Command\MoveForwardCommand;
use Botty\Command\TurnLeftCommand;
use Botty\Command\TurnRightCommand;
use Botty\Data\Coordinates;
use Botty\Robot\BasicRobot;
use Botty\Robot\Component\NavigatorComponent;
use PHPUnit\Framework\TestCase;

class BasicRobotTest extends TestCase
{
    /**
     * @test
     */
    public function testItCanTurn()
    {
        $navigator = new NavigatorComponent(new Coordinates());
        $robot = new BasicRobot($navigator);

        $command1 = new TurnLeftCommand();
        $command2 = new TurnRightCommand();

        // Turn left
        $robot->runCommand($command1);
        $this->assertEquals(NavigatorComponent::FACING_EAST, $robot->getFacing());

        // Turn right
        $robot->runCommand($command2);
        $this->assertEquals(NavigatorComponent::FACING_SOUTH, $robot->getFacing());
    }

    /**
     * @test
     */
    public function testItCanMove()
    {
        $navigator = new NavigatorComponent(new Coordinates());
        $robot = new BasicRobot($navigator);

        $forwardCommand = new MoveForwardCommand();
        $backwardsCommand = new MoveBackwardsCommand();

        // Go forward twice
        $robot->runCommand($forwardCommand);
        $robot->runCommand($forwardCommand);

        $this->assertEquals(2, $robot->getPositionY());

        // Go back once
        $robot->runCommand($backwardsCommand);
        $this->assertEquals(1, $robot->getPositionY());

    }
}