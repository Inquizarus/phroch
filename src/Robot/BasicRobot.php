<?php
namespace Botty\Robot;

use Botty\Command\AbstractCommand;
use Botty\Command\CommandInterface;
use Botty\Data\Coordinates;
use Botty\LoggerInterface;
use Botty\Robot\Component\NavigatorComponentInterface;
use Botty\Robot\Component\UplinkComponentInterface;

class BasicRobot implements RobotInterface
{
    /** @var NavigatorComponentInterface */
    private $navigator = null;

    /** @var UplinkComponentInterface */
    private $uplink = null;

    /** @var LoggerInterface */
    private $logger;

    /**
     * BasicRobot constructor.
     *
     * @param NavigatorComponentInterface $navigator
     * @param UplinkComponentInterface $uplink
     * @param LoggerInterface $logger
     */
    public function __construct(NavigatorComponentInterface $navigator, UplinkComponentInterface $uplink, LoggerInterface $logger)
    {
        $this->navigator = $navigator;
        $this->uplink = $uplink;
        $this->logger = $logger;
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
        $this->moveToNewPosition($newCoordinates);
    }

    /**
     * @return void
     */
    private function moveBackwards()
    {
        $newCoordinates = $this->navigator->calculateNewPositionBackwards();
        if (
            $this->uplink->areCoordinatesOutOfBounds($newCoordinates) === false &&
            $this->uplink->areCoordinatesOccupied($newCoordinates) === false
        ) {
            $this->navigator->setNewPosition($newCoordinates);
        }
    }

    /**
     * @param Coordinates $newCoordinates
     */
    private function moveToNewPosition(Coordinates $newCoordinates): void
    {
        if ($this->uplink->areCoordinatesOccupied($newCoordinates)) {
            $this->logger->error(sprintf('An obstacle is in the way at %s,%s!', $newCoordinates->x, $newCoordinates->y));
            return;
        } elseif ($this->uplink->areCoordinatesOutOfBounds($newCoordinates)) {
            $this->logger->error(sprintf('%s,%s are out of bounds!', $newCoordinates->x, $newCoordinates->y));
            return;
        }
        $this->navigator->setNewPosition($newCoordinates);
    }

}