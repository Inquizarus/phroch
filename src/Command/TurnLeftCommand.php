<?php
namespace Botty\Command;

class TurnLeftCommand extends AbstractCommand implements TurnCommandInterface
{
    /**
     * TurnLeftCommand constructor.
     */
    public function __construct()
    {
        parent::__construct(parent::PRIMARY_PROTOCOL_FACING, parent::SECONDARY_PROTOCOL_OMEGA);
    }
}