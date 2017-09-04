<?php
namespace Botty\Test\Robot\Component;

use Botty\Command\MoveBackwardsCommand;
use Botty\Command\MoveForwardCommand;
use Botty\Command\TurnLeftCommand;
use Botty\Command\TurnRightCommand;
use Botty\Data\Coordinates;
use Botty\Logger;
use Botty\Robot\Component\NavigatorComponent;
use PHPUnit\Framework\TestCase;

class NavigatorComponentTest extends TestCase
{
    /**
     * @test
     */
    public function testItCanReturnCorrectCurrentFacingAndPosition()
    {
        $coordinates = new Coordinates;
        $coordinates->x = 7;
        $coordinates->y = 3;
        $navigator = new NavigatorComponent($coordinates, NavigatorComponent::FACING_WEST, new Logger());

        $this->assertEquals(7, $navigator->getCurrentPositionX());
        $this->assertEquals(3, $navigator->getCurrentPositionY());
        $this->assertEquals(NavigatorComponent::FACING_WEST, $navigator->getCurrentFacing());
    }

    /**
     * @test
     */
    public function testItInterpretsTurnCommandsCorrectly()
    {
        $coordinates = new Coordinates;
        $navigator = new NavigatorComponent($coordinates, NavigatorComponent::FACING_SOUTH, new Logger());

        $command1 = new TurnRightCommand();
        $command2 = new TurnLeftCommand();

        // Right one time
        $navigator->turn($command1);
        $this->assertEquals(NavigatorComponent::FACING_WEST, $navigator->getCurrentFacing());

        // Left two timesa
        $navigator->turn($command2);
        $navigator->turn($command2);
        $this->assertEquals(NavigatorComponent::FACING_EAST, $navigator->getCurrentFacing());
    }

    /**
     * @test
     */
    public function testItCanCalculateNewPositions()
    {
        $coordinates = new Coordinates;
        $coordinates->y = 1;
        $coordinates->x = 1;
        $navigator = new NavigatorComponent($coordinates, NavigatorComponent::FACING_SOUTH, new Logger());

        $expected1 = new  Coordinates();
        $expected1->x = 1;
        $expected1->y = 2;

        $expected2 = new  Coordinates();
        $expected2->x = 1;
        $expected2->y = 0;

        $result1 = $navigator->calculateNewPositionForward();
        $result2 = $navigator->calculateNewPositionBackwards();

        $this->assertEquals($expected1, $result1);
        $this->assertEquals($expected2, $result2);

    }
}