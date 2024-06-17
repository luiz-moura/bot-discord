<?php

namespace Infra\Bot\Discord;

use Domain\ChatAI\Actions\ToAskAction;

class DiscordService
{
    private $message;

    public function __construct(private ToAskAction $toAskAction)
    {
    }

    public function setMessage($message): self
    {
        $this->message = $message;

        return $this;
    }

    public function replyWithChatAI(): void
    {
        if ($this->isBot()) {
            return;
        }

        $this->message->reply(
            ($this->toAskAction)($this->getContent())
        );
    }

    private function isBot(): bool
    {
        return $this->message->author->bot;
    }

    private function getContent(): string
    {
        return $this->message->content;
    }
}
