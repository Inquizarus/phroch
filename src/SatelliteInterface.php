<?php
namespace Botty;

use Botty\Data\Coordinates;

interface SatelliteInterface
{
    /**
     * @param Coordinates $coordinates
     * @return bool
     */
    public function areCoordinatesOutOfBounds(Coordinates $coordinates): bool;

    /**
     * @param Coordinates $coordinates
     * @return bool
     */
    public function areCoordinatesOccupied(Coordinates $coordinates): bool;
}