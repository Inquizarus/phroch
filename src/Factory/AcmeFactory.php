<?php
namespace Botty\Factory;

use Botty\Data\Coordinates;
use Botty\Grid;
use Botty\GridInterface;
use Botty\Input\BasicInputDevice;
use Botty\Input\InputDeviceInterface;
use Botty\LoggerInterface;
use Botty\Robot\BasicRobot;
use Botty\Robot\Component\NavigatorComponent;
use Botty\Robot\Component\NavigatorComponentInterface;
use Botty\Robot\Component\UplinkComponent;
use Botty\Robot\Component\UplinkComponentInterface;
use Botty\Robot\RobotInterface;
use Botty\Satellite;
use Botty\SatelliteInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * ACME is a producer of extremely diverse products to very affordable prices.
 * In reality, to gain a bit better control and quality you would perhaps outsource the
 * production of components to different sub factories. But ACME is great for examples still!
 *
 * @package Botty\Factory
 */
class AcmeFactory implements AcmeFactoryInterface
{
    const GRID_X_QUERY_KEY = 'gridX';
    const GRID_Y_QUERY_KEY = 'gridY';

    const GRID_X_FALLBACK = 10;
    const GRID_Y_FALLBACK = 10;

    const POSITION_X_QUERY_KEY = 'positionX';
    const POSITION_Y_QUERY_KEY = 'positionY';

    /** @var LoggerInterface */
    private $logger = null;

    /**
     * AcmeFactory constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

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
        $facingCodes = [
            'n' => NavigatorComponent::FACING_NORTH,
            'north' => NavigatorComponent::FACING_NORTH,
            'e' => NavigatorComponent::FACING_EAST,
            'east' => NavigatorComponent::FACING_EAST,
            's' => NavigatorComponent::FACING_SOUTH,
            'south' => NavigatorComponent::FACING_SOUTH,
            'w' => NavigatorComponent::FACING_WEST,
            'west' => NavigatorComponent::FACING_WEST
        ];

        $facing = $request->query->get('facing');
        $facing = $facing && isset($facingCodes[$facing]) ? $facingCodes[$facing] : NavigatorComponent::FACING_SOUTH;

        $coordinates->x = (int) $request->query->get(self::POSITION_X_QUERY_KEY);
        $coordinates->y = (int) $request->query->get(self::POSITION_Y_QUERY_KEY);

        return new NavigatorComponent($coordinates, $facing, $this->logger);
    }

    /**
     * @inheritDoc
     */
    public function makeRobotWithComponents(NavigatorComponentInterface $navigator, UplinkComponentInterface $uplink): RobotInterface
    {
        return new BasicRobot($navigator, $uplink, $this->logger);
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

    /**
     * @inheritDoc
     */
    public function makeObstaclesFromRequest(Request $request): array
    {
        $obstacles = [];

        return $obstacles;
    }

}