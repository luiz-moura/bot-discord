<?php

namespace Domain\Bot\Contracts;

interface BotService
{
    public function setMessage($message): self;
    public function setBot($bot): self;
    public function getUserName(): string;
    public function getMessageUserId(): int;
    public function getMessageContent(): string;
    public function messageAuthorIsBot(): bool;
    public function getBotId(): int;
    public function botNotMentioned(): bool;
    public function reply(string $message): void;
}
