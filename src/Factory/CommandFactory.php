<?php
namespace Botty\Factory;

use Botty\Command\CommandInterface;
use Botty\Command\MoveBackwardsCommand;
use Botty\Command\MoveForwardCommand;
use Botty\Command\TurnLeftCommand;
use Botty\Command\TurnRightCommand;
use Symfony\Component\HttpFoundation\Request;

class CommandFactory implements CommandFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function makeCommandFromString(string $commandString): ?CommandInterface
    {
        switch ($commandString) {
            case 'l':
                $command = new TurnLeftCommand();
                break;
            case 'r':
                $command = new TurnRightCommand();
                break;
            case 'f':
                $command = new MoveForwardCommand();
                break;
            case 'b':
                $command = new MoveBackwardsCommand();
                break;
            default:
                $command = null;
        }
        return $command;
    }

    /**
     * @inheritDoc
     */
    public function makeCommandsFromString(string $commandsString): array
    {
        $commands = [];
        for ($x=0;$x<strlen($commandsString);$x++) {
            if ($command = $this->makeCommandFromString($commandsString[$x])) {
                $commands[] = $command;
            }
        }
        return $commands;
    }

    /**
     * @inheritDoc
     */
    public function makeCommandsFromRequest(Request $request): array
    {
        $commandsString = (string) $request->query->get('commands');
        return $this->makeCommandsFromString($commandsString);
    }

}