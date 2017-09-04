<?php
namespace Botty\Test\Robot;

use Botty\Command\MoveBackwardsCommand;
use Botty\Command\MoveForwardCommand;
use Botty\Command\TurnLeftCommand;
use Botty\Command\TurnRightCommand;
use Botty\Data\Coordinates;
use Botty\Grid;
use Botty\Logger;
use Botty\Robot\BasicRobot;
use Botty\Robot\Component\NavigatorComponent;
use Botty\Robot\Component\UplinkComponent;
use Botty\Robot\Component\UplinkComponentInterface;
use Botty\Satellite;
use PHPUnit\Framework\TestCase;

class BasicRobotTest extends TestCase
{
    /**
     * @test
     */
    public function testItCanTurn()
    {
        $navigator = new NavigatorComponent(new Coordinates(), NavigatorComponent::FACING_SOUTH, new Logger());
        $uplink = $this->getMockBuilder(UplinkComponentInterface::class)
            ->setMethodsExcept()
            ->getMock();
        $robot = new BasicRobot($navigator, $uplink, new Logger());

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
        $navigator = new NavigatorComponent(new Coordinates(), NavigatorComponent::FACING_SOUTH, new Logger());
        $uplink = $this->getMockBuilder(UplinkComponentInterface::class)
            ->setMethodsExcept()
            ->getMock();
        $uplink->expects($this->any())
            ->method('areCoordinatesOccupied')
            ->will($this->returnValue(false));
        $uplink->expects($this->any())
            ->method('areCoordinatesOccupied')
            ->will($this->returnValue(false));
        $robot = new BasicRobot($navigator, $uplink, new Logger());

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

    /**
     * @test
     */
    public function testItValidatesMoveNotBeingOOBBeforeMoving()
    {
        $grid = new Grid(1, 2);
        $satellite = new Satellite($grid);
        $uplink = new UplinkComponent($satellite);
        $navigator = new NavigatorComponent(new Coordinates(), NavigatorComponent::FACING_SOUTH, new Logger());
        $robot = new BasicRobot($navigator, $uplink, new Logger());
        $grid->addRobot($robot);

        $outOfBoundsMoveCommand = new MoveBackwardsCommand();
        $validMoveCommand = new MoveForwardCommand();

        $robot->runCommand($outOfBoundsMoveCommand);
        $this->assertEquals(0, $robot->getPositionY());

        $robot->runCommand($validMoveCommand);
        $this->assertEquals(1, $robot->getPositionY());
    }

    /**
     * @test
     */
    public function testItValidatesMoveNotBeingOccupiedBeforeMoving()
    {
        $grid = new Grid(1, 3);
        $satellite = new Satellite($grid);
        $uplink = new UplinkComponent($satellite);
        $startCoordinates = new Coordinates();
        $startCoordinates->x = 0;
        $startCoordinates->y = 1;

        $navigator = new NavigatorComponent($startCoordinates, NavigatorComponent::FACING_SOUTH, new Logger());
        $robot = new BasicRobot($navigator, $uplink, new Logger());
        $grid->addRobot($robot);

        // This will be occupying 0,0 in the grid. Right behind moving robot.
        $navigator2 = new NavigatorComponent(new Coordinates(), NavigatorComponent::FACING_SOUTH, new Logger());
        $robot2 = new BasicRobot($navigator2, $uplink, new Logger());
        $grid->addRobot($robot2);

        $occupiedMoveCommand = new MoveBackwardsCommand();
        $validMoveCommand = new MoveForwardCommand();

        $robot->runCommand($occupiedMoveCommand);
        $this->assertEquals(1, $robot->getPositionY());

        $robot->runCommand($validMoveCommand);
        $this->assertEquals(2, $robot->getPositionY());
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function testItThrowsExceptionWhenShutdownSignalIsReceived()
    {
        $grid = new Grid(1, 3);
        $satellite = new Satellite($grid);
        $uplink = new UplinkComponent($satellite);

        $startCoordinates = new Coordinates();
        $startCoordinates->x = 0;
        $startCoordinates->y = 0;

        $navigator = new NavigatorComponent($startCoordinates, NavigatorComponent::FACING_NORTH, new Logger());
        $robot = new BasicRobot($navigator, $uplink, new Logger());
        $grid->addRobot($robot);
        $robot->runCommand(new MoveForwardCommand());
        $robot->runCommand(new MoveForwardCommand());
    }
}