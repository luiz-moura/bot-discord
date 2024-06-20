<?php

namespace Domain\Bot\Contracts;

use Domain\Bot\DTOs\MessageData;
use Domain\ChatAI\Enums\MessageRolesEnum;

interface MessageRepository
{
    /**
     * @return \Domain\Bot\DTOs\MessageData[]
     */
    public function queryMessagesFromLastContextByUserId(int $discordId): array;
    public function create(int $contextId, MessageRolesEnum $author, string $message): MessageData;
}
