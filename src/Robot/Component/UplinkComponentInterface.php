<?php
namespace Botty\Robot\Component;

use Botty\Data\Coordinates;

interface UplinkComponentInterface
{
    /**
     * @param Coordinates $coordinates
     * @return bool
     */
    public function areCoordinatesOccupied(Coordinates $coordinates): bool;

    /**
     * @param Coordinates $coordinates
     * @return bool
     */
    public function areCoordinatesOutOfBounds(Coordinates $coordinates): bool;
}