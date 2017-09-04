<?php
namespace Botty\Obstacle;

class BasicObstacle implements ObstacleInterface
{
    private $positionX = null;

    private $positionY = null;

    /**
     * BasicObstacle constructor.
     *
     * @param int $positionX
     * @param int $positionY
     */
    public function __construct(int $positionX, int $positionY)
    {
        $this->positionX = $positionX;
        $this->positionY = $positionY;
    }

    /**
     * @inheritDoc
     */
    public function getPositionX(): int
    {
        return (int) $this->positionX;
    }

    /**
     * @inheritDoc
     */
    public function getPositionY(): int
    {
        return (int) $this->positionY;
    }

}