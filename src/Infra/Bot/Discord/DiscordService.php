<?php

namespace Infra\Bot\Discord;

use Domain\Bot\Contracts\BotService;

class DiscordService implements BotService
{
    private object $bot;
    private object $message;

    /**
     * @param \Discord\Parts\Channel\Message $message
     */
    public function setMessage($message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param \Discord\Discord $bot
     */
    public function setBot($bot): self
    {
        $this->bot = $bot;

        return $this;
    }

    public function getUserName(): string
    {
        return $this->message->author->username;
    }

    public function getMessageUserId(): int
    {
        return $this->message->author->id;
    }

    public function getMessageContent(): string
    {
        return $this->removeBotMarketion($this->message->content);
    }

    public function messageAuthorIsBot(): bool
    {
        return (bool) $this->message->author->bot;
    }

    public function getBotId(): int
    {
        return $this->bot->id;
    }

    public function botNotMentioned(): bool
    {
        $botId = $this->bot->id;
        $mentions = array_keys($this->message->mentions->toArray());

        return !in_array($botId, $mentions);
    }

    public function reply(string $message): void
    {
        $this->message->reply($message);
    }

    private function removeBotMarketion(string $message): string
    {
        $mentionTag = "<@!{$this->getBotId()}>";

        return str_replace($mentionTag, '', $message);
    }
}
