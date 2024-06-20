<?php

namespace Domain\Bot\Contracts;

interface BotService
{
    public function setMessage(object $message): self;
    public function getUserName(): string;
    public function getUserId(): int;
    public function getContent(): string;
    public function isBot(): bool;
    public function reply(string $message): void;
}
