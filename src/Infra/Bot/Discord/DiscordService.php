<?php

namespace Infra\Bot\Discord;

use Domain\Bot\Contracts\BotService as BotServiceContract;
use Domain\ChatAI\Actions\ToAskAction;

class DiscordService implements BotServiceContract
{
    public function __construct(private ToAskAction $toAskAction)
    {
    }

    public function reply($message): void
    {
        if ($message->author->bot) {
            return;
        }

        if ($message->content == 'ping') {
            $message->reply('pong');

            return;
        }

        $message->reply(
            ($this->toAskAction)($message->content)
        );
    }
}
