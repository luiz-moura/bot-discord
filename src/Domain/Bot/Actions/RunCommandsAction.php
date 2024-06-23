<?php

namespace Domain\Bot\Actions;

use Domain\Bot\Enums\BotCommandsEnum;

class RunCommandsAction
{
    public function __construct(private CreateNewContextForuserAction $createNewContextForUserAction) {
    }

    public function __invoke(BotCommandsEnum $command, int $userId): string
    {
        return match ($command) {
            BotCommandsEnum::HELP => $this->listAvailableCommands(),
            BotCommandsEnum::RESET => $this->createNewContextForUser($userId),
        };
    }

    private function listAvailableCommands(): string
    {
        $commands = "[reset context] Começar novo contexto de conversa" . PHP_EOL;
        $commands .= "[help] Lista comandos disponiveis" . PHP_EOL;

        return $commands;
    }

    private function createNewContextForUser($userId): string
    {
        ($this->createNewContextForUserAction)($userId);

        return 'message context reset successfully!';
    }
}
