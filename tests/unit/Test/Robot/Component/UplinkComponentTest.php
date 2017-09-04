<?php
namespace Botty\Test\Robot\Component;

use Botty\Data\Coordinates;
use Botty\Robot\Component\UplinkComponent;
use Botty\SatelliteInterface;
use PHPUnit\Framework\TestCase;

class UplinkComponentTest extends TestCase
{
    public function testItValidatesIfCoordinatesAreOccupied()
    {
        $satellite = $this->getMockBuilder(SatelliteInterface::class)
            ->setMethods(['areCoordinatesOccupied', 'areCoordinatesOutOfBounds'])
            ->getMock();

        $satellite->expects($this->atLeastOnce())
            ->method('areCoordinatesOccupied')
            ->will($this->returnValue(true));

        /**
         * @var SatelliteInterface $satellite
         */

        $uplink = new UplinkComponent($satellite);

        $this->assertTrue($uplink->areCoordinatesOccupied(new Coordinates()));
    }
}