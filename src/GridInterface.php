<?php
namespace Botty;

use Botty\Obstacle\ObstacleInterface;
use Botty\Robot\RobotInterface;

interface GridInterface
{
    /**
     * Get x-axis size of grid
     *
     * @return int
     */
    public function getSizeX(): int;

    /**
     * Get y-axis size of grid
     *
     * @return int
     */
    public function getSizeY(): int;

    /**
     * Get full list of all robots on map
     *
     * @return RobotInterface[]
     */
    public function getRobots(): array;

    /**
     * Get full list of all obstacles on map
     *
     * @return ObstacleInterface[]
     */
    public function getObstacles(): array;

    /**
     * Add a robot to the map
     *
     * @param RobotInterface $robot
     *
     * @return GridInterface
     */
    public function addRobot(RobotInterface $robot): GridInterface;

    /**
     * Add an obstacle to the map
     *
     * @param ObstacleInterface $obstacle
     *
     * @return GridInterface
     */
    public function addObstacle(ObstacleInterface $obstacle): GridInterface;
}