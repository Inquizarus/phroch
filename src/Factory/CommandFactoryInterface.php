<?php
namespace Botty\Factory;

use Botty\Command\CommandInterface;
use Symfony\Component\HttpFoundation\Request;

interface CommandFactoryInterface
{
    /**
     * @param string $commandString
     *
     * @return CommandInterface|null
     */
    public function makeCommandFromString(string $commandString): ?CommandInterface;

    /**
     * @param string $commandsString
     *
     * @return array
     */
    public function makeCommandsFromString(string $commandsString): array;

    /**
     * @param Request $request
     *
     * @return array
     */
    public function makeCommandsFromRequest(Request $request): array;
}