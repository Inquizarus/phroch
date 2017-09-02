<?php
namespace Botty\Command;

abstract class AbstractCommand implements CommandInterface
{

    const PRIMARY_PROTOCOL_MOVEMENT  = 10;
    const PRIMARY_PROTOCOL_FACING    = 20;

    const SECONDARY_PROTOCOL_ALPHA   = 1;
    const SECONDARY_PROTOCOL_OMEGA   = 2;

    const COMMAND_MOVE_FORWARD   = self::PRIMARY_PROTOCOL_MOVEMENT + self::SECONDARY_PROTOCOL_ALPHA;
    const COMMAND_MOVE_BACKWARDS = self::PRIMARY_PROTOCOL_MOVEMENT + self::SECONDARY_PROTOCOL_OMEGA;

    const COMMAND_TURN_RIGHT = self::PRIMARY_PROTOCOL_FACING + self::SECONDARY_PROTOCOL_ALPHA;
    const COMMAND_TURN_LEFT  = self::PRIMARY_PROTOCOL_FACING + self::SECONDARY_PROTOCOL_OMEGA;

    /** @var int|null */
    private $primaryProtocol = null;

    /** @var int|null */
    private $secondaryProtocol = null;

    /**
     * AbstractCommand constructor.
     *
     * @param int $primaryProtocol
     * @param int $secondaryProtocol
     */
    public function __construct(int $primaryProtocol, int $secondaryProtocol)
    {
        $this->primaryProtocol = $primaryProtocol;
        $this->secondaryProtocol = $secondaryProtocol;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): int
    {
        return $this->primaryProtocol + $this->secondaryProtocol;
    }
}