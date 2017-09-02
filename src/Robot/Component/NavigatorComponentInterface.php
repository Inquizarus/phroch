<?php
namespace Botty\Robot\Component;

use Botty\Command\CommandInterface;
use Botty\Data\Coordinates;

interface NavigatorComponentInterface
{
    /**
     * @return int
     */
    public function getCurrentPositionX(): int;

    /**
     * @return int
     */
    public function getCurrentPositionY(): int;

    /**
     * @return int
     */
    public function getCurrentFacing(): int;

    /**
     * @param CommandInterface $turnCommand
     *
     * @return NavigatorComponentInterface
     */
    public function turn(CommandInterface $turnCommand): NavigatorComponentInterface;

    /**
     * @return Coordinates
     */
    public function calculateNewPositionForward(): Coordinates;

    /**
     * @return Coordinates
     */
    public function calculateNewPositionBackwards(): Coordinates;

    /**
     * @param Coordinates $coordinates
     *
     * @return NavigatorComponentInterface
     */
    public function setNewPosition(Coordinates $coordinates): NavigatorComponentInterface;
}