<?php
namespace Botty\Command;

interface CommandInterface
{
    /**
     * Return numeric representation of command
     *
     * @return int
     */
    public function getType(): int;
}