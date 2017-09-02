<?php
namespace Botty\Robot;

use Botty\Command\CommandInterface;

interface RobotInterface
{
    /**
     * Runs passed command
     *
     * @param CommandInterface $command
     *
     * @return RobotInterface
     */
    public function runCommand(CommandInterface $command): RobotInterface;

    /**
     * @return int
     */
    public function getFacing(): int;

    /**
     * @return int
     */
    public function getPositionX(): int;

    /**
     * @return int
     */
    public function getPositionY(): int;
}