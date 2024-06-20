<?php

namespace Infra\Bot\Discord;

use Domain\Bot\Contracts\BotService;

class DiscordService implements BotService
{
    private $message;

    public function setMessage($message): self
    {
        $this->message = $message;

        return $this;
    }

    public function reply(string $message): void
    {
        $this->message->reply($message);
    }

    public function getUserId(): int
    {
        return $this->message->author->id;
    }

    public function getUserName(): string
    {
        return $this->message->author->username;
    }

    public function isBot(): bool
    {
        return (bool) $this->message->author->bot;
    }

    public function getContent(): string
    {
        return $this->message->content;
    }
}
