<?php
namespace Botty\Obstacle;

interface ObstacleInterface
{
    /**
     * @return int
     */
    public function getPositionX(): int;

    /**
     * @return int
     */
    public function getPositionY(): int;
}