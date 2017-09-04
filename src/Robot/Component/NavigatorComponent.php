<?php
namespace Botty\Robot\Component;

use Botty\Command\AbstractCommand;
use Botty\Command\CommandInterface;
use Botty\Data\Coordinates;
use Botty\LoggerInterface;

class NavigatorComponent implements NavigatorComponentInterface
{
    const FACING_NORTH = 0;
    const FACING_EAST  = 1;
    const FACING_SOUTH = 2;
    const FACING_WEST  = 3;

    private $facingStringMap = [
        self::FACING_NORTH => 'north',
        self::FACING_EAST => 'east',
        self::FACING_SOUTH => 'south',
        self::FACING_WEST => 'west'
    ];

    /** @var Coordinates */
    private $coordinates = null;

    /** @var int */
    private $facing = null;

    /** @var LoggerInterface */
    private $logger = null;

    public function __construct(Coordinates $coordinates, int $facing = self::FACING_SOUTH, LoggerInterface $logger)
    {
        $this->coordinates = $coordinates;
        $this->facing = $facing;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function getCurrentPositionX(): int
    {
        return (int) $this->coordinates->x;
    }

    /**
     * @inheritDoc
     */
    public function getCurrentPositionY(): int
    {
        return (int) $this->coordinates->y;
    }

    /**
     * @inheritDoc
     */
    public function getCurrentFacing(): int
    {
        return (int) $this->facing;
    }

    /**
     * @inheritDoc
     */
    public function turn(CommandInterface $turnCommand): NavigatorComponentInterface
    {
        if ($turnCommand->getType() === AbstractCommand::COMMAND_TURN_RIGHT) {
            $this->turnRight();
        } elseif ($turnCommand->getType() === AbstractCommand::COMMAND_TURN_LEFT) {
            $this->turnLeft();
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function calculateNewPositionForward(): Coordinates
    {
        $coordinates = clone $this->coordinates;
        switch ($this->getCurrentFacing()) {
            case self::FACING_EAST:
                $coordinates->x++;
                break;
            case self::FACING_WEST:
                $coordinates->x--;
                break;
            case self::FACING_NORTH:
                $coordinates->y--;
                break;
            case self::FACING_SOUTH:
                $coordinates->y++;
                break;
        }
        return $coordinates;
    }

    /**
     * @inheritDoc
     */
    public function calculateNewPositionBackwards(): Coordinates
    {
        $coordinates = clone $this->coordinates;
        switch ($this->getCurrentFacing()) {
            case self::FACING_EAST:
                $coordinates->x--;
                break;
            case self::FACING_WEST:
                $coordinates->x++;
                break;
            case self::FACING_NORTH:
                $coordinates->y++;
                break;
            case self::FACING_SOUTH:
                $coordinates->y--;
                break;
        }
        return $coordinates;
    }

    /**
     * @inheritDoc
     */
    public function setNewPosition(Coordinates $coordinates): NavigatorComponentInterface
    {
        $this->coordinates = $coordinates;
        return $this;
    }

    /**
     * @return void
     */
    private function turnRight(): void
    {
        if ($this->getCurrentFacing() === self::FACING_WEST) {
            $this->facing = self::FACING_NORTH;
        } else {
            $this->facing = $this->facing + 1;
        }
        $this->logger->info(sprintf('Turned right, now facing %s', $this->facingStringMap[$this->facing]));
    }

    /**
     * @return void
     */
    private function turnLeft(): void
    {
        if ($this->getCurrentFacing() === self::FACING_NORTH) {
            $this->facing = self::FACING_WEST;
        } else {
            $this->facing = $this->facing - 1;
        }
        $this->logger->info(sprintf('Turned left, now facing %s', $this->facingStringMap[$this->facing]));
    }

}