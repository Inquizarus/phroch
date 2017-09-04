<?php
namespace Botty\Test;

use Botty\Data\Coordinates;
use Botty\Grid;
use Botty\Obstacle\BasicObstacle;
use Botty\Satellite;
use PHPUnit\Framework\TestCase;

class SatelliteTest extends TestCase
{
    /**
     * @test
     */
    public function testItReturnsTrueIfCoordinatesAreOutOfBounds()
    {
        $coordinates = new Coordinates();
        $coordinates->x = 15;
        $grid = new Grid(10, 10);
        $satellite = new Satellite($grid);
        $this->assertTrue($satellite->areCoordinatesOutOfBounds($coordinates));
    }

    /**
     * @test
     */
    public function testItReturnsFalseIfCoordinatesAreNotOutOfBounds()
    {
        $coordinates = new Coordinates();
        $coordinates->x = 9;
        $coordinates->y = 5;
        $grid = new Grid(10, 10);
        $satellite = new Satellite($grid);
        $this->assertFalse($satellite->areCoordinatesOutOfBounds($coordinates));
    }

    /**
     * @test
     */
    public function testItReturnsTrueIfCoordinatesAreOccupied()
    {
        $coordinates = new Coordinates();
        $coordinates->x = 5;
        $coordinates->y = 5;
        $grid = new Grid(10, 10);
        $satellite = new Satellite($grid);
        $obstacle = new BasicObstacle(5, 5);
        $grid->addObstacle($obstacle);
        $this->assertTrue($satellite->areCoordinatesOccupied($coordinates));
    }

    /**
     * @test
     */
    public function testItReturnsFalseIfCoordinatesAreNotOccupied()
    {
        $coordinates = new Coordinates();
        $coordinates->x = 2;
        $coordinates->y = 2;
        $grid = new Grid(10, 10);
        $satellite = new Satellite($grid);
        $obstacle = new BasicObstacle(5, 5);
        $grid->addObstacle($obstacle);
        $this->assertFalse($satellite->areCoordinatesOccupied($coordinates));
    }
}