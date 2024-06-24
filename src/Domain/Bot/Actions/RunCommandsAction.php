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
        $commands = 'Greetings! These are the available commands' . PHP_EOL;
        $commands .= '[reset context] Start new conversation context' . PHP_EOL;
        $commands .= '[help] List available commands' . PHP_EOL;
        $commands .= ' > Ask a question to get started! ';

        return $commands;
    }

    private function createNewContextForUser($userId): string
    {
        ($this->createNewContextForUserAction)($userId);

        return 'Message context reset successfully!';
    }
}
