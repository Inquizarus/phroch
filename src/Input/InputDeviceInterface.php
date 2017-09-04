<?php
namespace Botty\Input;

use Botty\Command\CommandInterface;
use Botty\Robot\RobotInterface;

interface InputDeviceInterface
{
    /**
     * @param RobotInterface $robot
     *
     * @return InputDeviceInterface
     */
    public function attachRobot(RobotInterface $robot): InputDeviceInterface;

    /**
     * @param CommandInterface $command
     *
     * @return bool
     */
    public function runCommand(CommandInterface $command): bool;

    /**
     * @param CommandInterface[] $commands
     *
     * @return bool
     */
    public function runCommands(array $commands): bool;

    /**
     * @return bool
     */
    public function forward(): bool;

    /**
     * @return bool
     */
    public function backwards(): bool;

    /**
     * @return bool
     */
    public function left(): bool;

    /**
     * @return bool
     */
    public function right(): bool;
}