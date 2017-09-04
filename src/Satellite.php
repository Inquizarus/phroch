<?php
namespace Botty;

use Botty\Data\Coordinates;

class Satellite implements SatelliteInterface
{
    /** @var GridInterface */
    private $grid = null;

    /**
     * Satellite constructor.
     *
     * @param GridInterface $grid
     */
    public function __construct(GridInterface $grid)
    {
        $this->grid = $grid;
    }

    /**
     * @inheritDoc
     */
    public function areCoordinatesOutOfBounds(Coordinates $coordinates): bool
    {
        $minX = 0;
        $minY = 0;
        $maxX = $this->grid->getSizeX() - 1;
        $maxY = $this->grid->getSizeY() - 1;

        $oobX = $coordinates->x < $minX || $coordinates->x > $maxX ? true : false;
        $oobY = $coordinates->y < $minY || $coordinates->y > $maxY ? true : false;

        return $oobX === true || $oobY === true ? true :false;
    }

    /**
     * @inheritDoc
     */
    public function areCoordinatesOccupied(Coordinates $coordinates): bool
    {
        foreach ($this->grid->getObstacles() as $obstacle) {
            $occupiedX = $obstacle->getPositionX() === $coordinates->x;
            $occupiedY = $obstacle->getPositionY() === $coordinates->y;
            if ($occupiedX && $occupiedY) {
                return true;
            }
        }
        foreach ($this->grid->getRobots() as $robot) {
            $occupiedX = $robot->getPositionX() === $coordinates->x;
            $occupiedY = $robot->getPositionY() === $coordinates->y;
            if ($occupiedX && $occupiedY) {
                return true;
            }
        }
        return false;
    }

}