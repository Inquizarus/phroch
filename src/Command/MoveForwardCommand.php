<?php
namespace Botty\Command;

class MoveForwardCommand extends AbstractCommand
{
    /**
     * MoveForwardCommand constructor.
     */
    public function __construct()
    {
        parent::__construct(parent::PRIMARY_PROTOCOL_MOVEMENT, parent::SECONDARY_PROTOCOL_ALPHA);
    }
}