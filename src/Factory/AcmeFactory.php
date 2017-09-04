<?php
namespace Botty\Factory;

use Botty\Data\Coordinates;
use Botty\Grid;
use Botty\GridInterface;
use Botty\Input\BasicInputDevice;
use Botty\Input\InputDeviceInterface;
use Botty\Robot\BasicRobot;
use Botty\Robot\Component\NavigatorComponent;
use Botty\Robot\Component\NavigatorComponentInterface;
use Botty\Robot\Component\UplinkComponent;
use Botty\Robot\Component\UplinkComponentInterface;
use Botty\Robot\RobotInterface;
use Botty\Satellite;
use Botty\SatelliteInterface;
use Symfony\Component\HttpFoundation\Request;

class AcmeFactory implements AcmeFactoryInterface
{
    const GRID_X_QUERY_KEY = 'gridX';
    const GRID_Y_QUERY_KEY = 'gridY';

    const GRID_X_FALLBACK = 10;
    const GRID_Y_FALLBACK = 10;

    const POSITION_X_QUERY_KEY = 'positionX';
    const POSITION_Y_QUERY_KEY = 'positionY';

    /**
     * @inheritDoc
     */
    public function makeGridFromRequest(Request $request): GridInterface
    {
        $x = $request->query->has(self::GRID_X_QUERY_KEY) ? $request->query->get(self::GRID_X_QUERY_KEY) : self::GRID_X_FALLBACK;
        $y = $request->query->has(self::GRID_Y_QUERY_KEY) ? $request->query->get(self::GRID_Y_QUERY_KEY) : self::GRID_Y_FALLBACK;
        return new Grid($x, $y);
    }

    /**
     * @inheritDoc
     */
    public function makeSatelliteWithGrid(GridInterface $grid): SatelliteInterface
    {
        return new Satellite($grid);
    }

    /**
     * @inheritDoc
     */
    public function makeUplinkWithSatellite(SatelliteInterface $satellite): UplinkComponentInterface
    {
        return new UplinkComponent($satellite);
    }

    /**
     * @inheritDoc
     */
    public function makeNavigatorFromRequest(Request $request): NavigatorComponentInterface
    {
        $coordinates = new Coordinates();

        $coordinates->x = (int) $request->query->get(self::POSITION_X_QUERY_KEY);
        $coordinates->y = (int) $request->query->get(self::POSITION_Y_QUERY_KEY);

        return new NavigatorComponent($coordinates);
    }

    /**
     * @inheritDoc
     */
    public function makeRobotWithComponents(NavigatorComponentInterface $navigator, UplinkComponentInterface $uplink): RobotInterface
    {
        return new BasicRobot($navigator, $uplink);
    }

    /**
     * @inheritDoc
     */
    public function makeInputDeviceWithRobot(RobotInterface $robot): InputDeviceInterface
    {
        $inputDevice = new BasicInputDevice();
        $inputDevice->attachRobot($robot);
        return $inputDevice;
    }

}