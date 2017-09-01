<?php
namespace Botty\Test;

use Botty\Grid;
use Botty\Obstacle\ObstacleInterface;
use Botty\Robot\RobotInterface;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    /**
     * @test
     */
    public function testItReturnsSizesCorrectly()
    {
        $sizeX = 10;
        $sizeY = 10;
        $grid = new Grid($sizeX, $sizeY);

        $this->assertEquals($sizeX, $grid->getSizeX());
        $this->assertEquals($sizeY, $grid->getSizeY());
    }

    /**
     * @test
     */
    public function testItCanAddRobotSuccessfully()
    {
        $grid = new Grid(10, 10);
        $robot = $this->getMockBuilder(RobotInterface::class)->getMock();

        /**
         * @var RobotInterface $robot
         */

        $grid->addRobot($robot);
        $this->assertEquals(1, count($grid->getRobots()));
    }

    /**
     * @test
     */
    public function testItCanAddObstacleSuccessfully()
    {
        $grid = new Grid(10, 10);
        $obstacle = $this->getMockBuilder(ObstacleInterface::class)->getMock();

        /**
         * @var ObstacleInterface $obstacle
         */

        $grid->addObstacle($obstacle);
        $this->assertEquals(1, count($grid->getObstacles()));
    }

}