<?php
namespace Botty\Robot;

use Botty\Command\AbstractCommand;
use Botty\Command\CommandInterface;
use Botty\Robot\Component\NavigatorComponentInterface;

class BasicRobot implements RobotInterface
{
    /** @var NavigatorComponentInterface */
    private $navigator = null;

    /**
     * BasicRobot constructor.
     *
     * @param NavigatorComponentInterface $navigator
     */
    public function __construct(NavigatorComponentInterface $navigator)
    {
        $this->navigator = $navigator;
    }

    /**
     * @inheritDoc
     */
    public function runCommand(CommandInterface $command): RobotInterface
    {
        if ($command->getType() > AbstractCommand::PRIMARY_PROTOCOL_FACING) {
            $this->navigator->turn($command);
        } elseif ($command->getType() > AbstractCommand::PRIMARY_PROTOCOL_MOVEMENT) {
            $this->move($command);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getFacing(): int
    {
        return (int) $this->navigator->getCurrentFacing();
    }

    /**
     * @inheritDoc
     */
    public function getPositionX(): int
    {
        return $this->navigator->getCurrentPositionX();
    }

    /**
     * @inheritDoc
     */
    public function getPositionY(): int
    {
        return $this->navigator->getCurrentPositionY();
    }

    /**
     * @param CommandInterface $command
     */
    private function move(CommandInterface $command)
    {
        if ($command->getType() === AbstractCommand::COMMAND_MOVE_FORWARD) {
            $this->moveForward();
        } elseif ($command->getType() === AbstractCommand::COMMAND_MOVE_BACKWARDS) {
            $this->moveBackwards();
        }
    }

    /**
     * @return void
     */
    private function moveForward()
    {
        $newCoordinates = $this->navigator->calculateNewPositionForward();
        $this->navigator->setNewPosition($newCoordinates);
    }

    /**
     * @return void
     */
    private function moveBackwards()
    {
        $newCoordinates = $this->navigator->calculateNewPositionBackwards();
        $this->navigator->setNewPosition($newCoordinates);
    }

}