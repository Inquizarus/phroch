<?php
namespace Botty\Factory;

use Botty\GridInterface;
use Botty\Input\InputDeviceInterface;
use Botty\Obstacle\ObstacleInterface;
use Botty\Robot\Component\NavigatorComponentInterface;
use Botty\Robot\Component\UplinkComponentInterface;
use Botty\Robot\RobotInterface;
use Botty\SatelliteInterface;
use Symfony\Component\HttpFoundation\Request;

interface AcmeFactoryInterface
{
    /**
     * @param Request $request
     *
     * @return GridInterface
     */
    public function makeGridFromRequest(Request $request): GridInterface;

    /**
     * @param GridInterface $grid
     *
     * @return SatelliteInterface
     */
    public function makeSatelliteWithGrid(GridInterface $grid): SatelliteInterface;

    /**
     * @param SatelliteInterface $satellite
     *
     * @return UplinkComponentInterface
     */
    public function makeUplinkWithSatellite(SatelliteInterface $satellite): UplinkComponentInterface;

    /**
     * @param Request $request
     *
     * @return NavigatorComponentInterface
     */
    public function makeNavigatorFromRequest(Request $request): NavigatorComponentInterface;

    /**
     * @param NavigatorComponentInterface $navigator
     * @param UplinkComponentInterface    $uplink
     *
     * @return RobotInterface
     */
    public function makeRobotWithComponents(NavigatorComponentInterface $navigator, UplinkComponentInterface $uplink): RobotInterface;

    /**
     * @param RobotInterface $robot
     *
     * @return InputDeviceInterface
     */
    public function makeInputDeviceWithRobot(RobotInterface $robot): InputDeviceInterface;

    /**
     * @param Request $request
     *
     * @return ObstacleInterface[]
     */
    public function makeObstaclesFromRequest(Request $request): array;

}