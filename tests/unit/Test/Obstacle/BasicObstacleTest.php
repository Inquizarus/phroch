<?php
namespace Botty\Test\Obstacle;

use Botty\Obstacle\BasicObstacle;
use PHPUnit\Framework\TestCase;

class BasicObstacleTest extends TestCase
{
    /**
     * @test
     */
    public function testItReturnsTheCorrectPositions()
    {
        $obstacle = new BasicObstacle(10, 11);
        $this->assertEquals(10, $obstacle->getPositionX());
        $this->assertEquals(11, $obstacle->getPositionY());
    }
}