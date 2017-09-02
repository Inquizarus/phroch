<?php
namespace Botty\Command;

class TurnRightCommand extends AbstractCommand
{
    /**
     * TurnRightCommand constructor.
     */
    public function __construct()
    {
        parent::__construct(parent::PRIMARY_PROTOCOL_FACING, parent::SECONDARY_PROTOCOL_ALPHA);
    }
}