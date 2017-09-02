<?php
namespace Botty\Command;

class MoveBackwardsCommand extends AbstractCommand
{
    /**
     * MoveBackwardsCommand constructor.
     */
    public function __construct()
    {
        parent::__construct(parent::PRIMARY_PROTOCOL_MOVEMENT, parent::SECONDARY_PROTOCOL_OMEGA);
    }
}