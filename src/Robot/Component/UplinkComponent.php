<?php
namespace Botty\Robot\Component;

use Botty\Data\Coordinates;
use Botty\SatelliteInterface;

class UplinkComponent implements UplinkComponentInterface
{
    /** @var SatelliteInterface */
    private $satellite = null;

    /**
     * UplinkComponent constructor.
     *
     * @param SatelliteInterface $satellite
     */
    public function __construct(SatelliteInterface $satellite)
    {
        $this->satellite = $satellite;
    }

    /**
     * @param Coordinates $coordinates
     * @return bool
     */
    public function areCoordinatesOccupied(Coordinates $coordinates): bool
    {
        return $this->satellite->areCoordinatesOccupied($coordinates);
    }

    /**
     * @param Coordinates $coordinates
     * @return bool
     */
    public function areCoordinatesOutOfBounds(Coordinates $coordinates): bool
    {
        return $this->satellite->areCoordinatesOutOfBounds($coordinates);
    }
}