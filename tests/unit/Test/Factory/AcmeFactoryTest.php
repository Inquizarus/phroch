<?php
namespace Botty\Test\Factory;

use Botty\Factory\AcmeFactory;
use Botty\Input\InputDeviceInterface;
use Botty\Logger;
use Botty\Robot\Component\UplinkComponentInterface;
use Botty\Robot\RobotInterface;
use Botty\SatelliteInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class AcmeFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function testItReturnsGridBasedOnRequest()
    {
        $request1 = new Request();
        $request2 = new Request([
            AcmeFactory::GRID_X_QUERY_KEY => 5,
            AcmeFactory::GRID_Y_QUERY_KEY => 7
        ]);

        $factory = new AcmeFactory(new Logger());

        $grid1 = $factory->makeGridFromRequest($request1);
        $grid2 = $factory->makeGridFromRequest($request2);

        $this->assertEquals(AcmeFactory::GRID_X_FALLBACK, $grid1->getSizeX());
        $this->assertEquals(AcmeFactory::GRID_Y_FALLBACK, $grid1->getSizeY());

        $this->assertEquals(5, $grid2->getSizeX());
        $this->assertEquals(7, $grid2->getSizeY());
    }

    /**
     * @test
     */
    public function testItReturnsSatellite()
    {
        $factory = new AcmeFactory(new Logger());
        $grid = $factory->makeGridFromRequest(new Request());
        $satellite = $factory->makeSatelliteWithGrid($grid);

        $this->assertInstanceOf(SatelliteInterface::class, $satellite);
    }

    /**
     * @test
     */
    public function testItReturnsUplink()
    {
        $factory = new AcmeFactory(new Logger());
        $grid = $factory->makeGridFromRequest(new Request());
        $satellite = $factory->makeSatelliteWithGrid($grid);
        $uplink = $factory->makeUplinkWithSatellite($satellite);

        $this->assertInstanceOf(UplinkComponentInterface::class, $uplink);
    }

    /**
     * @test
     */
    public function testItReturnsNavigatorBasedOnRequest()
    {
        $request1 = new Request();
        $request2 = new Request([
            AcmeFactory::POSITION_X_QUERY_KEY => 5,
            AcmeFactory::POSITION_Y_QUERY_KEY => 7
        ]);

        $factory = new AcmeFactory(new Logger());

        $navigator1 = $factory->makeNavigatorFromRequest($request1);
        $navigator2 = $factory->makeNavigatorFromRequest($request2);

        $this->assertEquals(0, $navigator1->getCurrentPositionX());
        $this->assertEquals(0, $navigator1->getCurrentPositionY());

        $this->assertEquals(5, $navigator2->getCurrentPositionX());
        $this->assertEquals(7, $navigator2->getCurrentPositionY());
    }

    /**
     * @test
     */
    public function testItReturnsRobot()
    {
        $factory = new AcmeFactory(new Logger());
        $grid = $factory->makeGridFromRequest(new Request());
        $satellite = $factory->makeSatelliteWithGrid($grid);
        $uplink = $factory->makeUplinkWithSatellite($satellite);
        $navigator = $factory->makeNavigatorFromRequest(new Request());
        $robot = $factory->makeRobotWithComponents($navigator, $uplink);

        $this->assertInstanceOf(RobotInterface::class, $robot);
    }

    /**
     * @test
     */
    public function testItReturnsInputDevice()
    {
        $factory = new AcmeFactory(new Logger());
        $grid = $factory->makeGridFromRequest(new Request());
        $satellite = $factory->makeSatelliteWithGrid($grid);
        $uplink = $factory->makeUplinkWithSatellite($satellite);
        $navigator = $factory->makeNavigatorFromRequest(new Request());
        $robot = $factory->makeRobotWithComponents($navigator, $uplink);
        $inputDevice = $factory->makeInputDeviceWithRobot($robot);
        $this->assertInstanceOf(InputDeviceInterface::class, $inputDevice);
    }
}