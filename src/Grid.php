<?php
namespace Botty;

use Botty\Obstacle\ObstacleInterface;
use Botty\Robot\RobotInterface;

class Grid implements GridInterface
{
    /** @var int|null */
    private $sizeX = null;

    /** @var int|null */
    private $sizeY = null;

    /** @var RobotInterface[] */
    private $robots = [];

    /** @var ObstacleInterface[] */
    private $obstacles = [];

    /**
     * Grid constructor.
     *
     * @param int $sizeX
     * @param int $sizeY
     */
    public function __construct(int $sizeX, int $sizeY)
    {
        $this->sizeX = $sizeX;
        $this->sizeY = $sizeY;
    }

    /**
     * Get x-axis size of grid
     *
     * @return int
     */
    public function getSizeX(): int
    {
        return (int) $this->sizeX;
    }

    /**
     * Get y-axis size of grid
     *
     * @return int
     */
    public function getSizeY(): int
    {
        return (int) $this->sizeY;
    }

    /**
     * @inheritDoc
     */
    public function getRobots(): array
    {
        return $this->robots;
    }

    /**
     * @inheritDoc
     */
    public function getObstacles(): array
    {
        return $this->obstacles;
    }

    /**
     * Add a robot to the map
     *
     * @param RobotInterface $robot
     *
     * @return GridInterface
     */
    public function addRobot(RobotInterface $robot): GridInterface
    {
        $this->robots[] = $robot;
        return $this;
    }

    /**
     * Add an obstacle to the map
     *
     * @param ObstacleInterface $obstacle
     *
     * @return GridInterface
     */
    public function addObstacle(ObstacleInterface $obstacle): GridInterface
    {
        $this->obstacles[] = $obstacle;
        return $this;
    }
}