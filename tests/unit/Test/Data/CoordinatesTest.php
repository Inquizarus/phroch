<?php
namespace Botty\Test\Data;

use Botty\Data\Coordinates;
use PHPUnit\Framework\TestCase;

class CoordinatesTest extends TestCase
{
    /**
     * @test
     */
    public function testItHaveDefaultValues()
    {
        $coordinates = new Coordinates();
        $this->assertEquals(0, $coordinates->x);
        $this->assertEquals(0, $coordinates->y);
    }
}