<?php
namespace Botty\Test\Factory;

use Botty\Factory\ObstacleFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ObstacleFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function testItCreatesObstacles()
    {
        $request = new Request([
            'obstacles' => '0,1-2,8'
        ]);

        $obstacleFactory = new ObstacleFactory();

        $obstacles = $obstacleFactory->makeObstaclesFromRequest($request);

        $this->assertEquals(2, count($obstacles));

        $this->assertEquals(0, $obstacles[0]->getPositionX());
        $this->assertEquals(1, $obstacles[0]->getPositionY());

        $this->assertEquals(2, $obstacles[1]->getPositionX());
        $this->assertEquals(8, $obstacles[1]->getPositionY());
    }
}