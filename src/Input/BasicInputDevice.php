<?php
namespace Botty\Input;

use Botty\Command\CommandInterface;
use Botty\Command\MoveBackwardsCommand;
use Botty\Command\MoveForwardCommand;
use Botty\Command\TurnLeftCommand;
use Botty\Command\TurnRightCommand;
use Botty\Robot\RobotInterface;

class BasicInputDevice implements InputDeviceInterface
{
    /** @var RobotInterface */
    private $robot = null;

    /**
     * @inheritDoc
     */
    public function attachRobot(RobotInterface $robot): InputDeviceInterface
    {
        $this->robot = $robot;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function runCommand(CommandInterface $command): bool
    {
        try {
            $this->robot->runCommand($command);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function runCommands(array $commands): bool
    {
        foreach ($commands AS $command) {
            if ($this->runCommand($command) !== true) {
                return false;
            }
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function forward(): bool
    {
        return $this->runCommand(new MoveForwardCommand());
    }

    /**
     * @inheritDoc
     */
    public function backwards(): bool
    {
        return $this->runCommand(new MoveBackwardsCommand());
    }

    /**
     * @inheritDoc
     */
    public function left(): bool
    {
        return $this->runCommand(new TurnLeftCommand());
    }

    /**
     * @inheritDoc
     */
    public function right(): bool
    {
        return $this->runCommand(new TurnRightCommand());
    }

}