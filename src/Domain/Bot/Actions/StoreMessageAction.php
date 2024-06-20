<?php

namespace Domain\Bot\Actions;

use Domain\Bot\Contracts\MessageContextRepository;
use Domain\Bot\Contracts\MessageRepository;
use Domain\ChatAI\Enums\MessageRolesEnum;

class StoreMessageAction
{
    public function __construct(
        private MessageRepository $messageRepository,
        private MessageContextRepository $messageContextRepository
    ) {
    }

    public function __invoke(
        int $userId,
        MessageRolesEnum $author,
        string $message,
        ?int $contextId = null
    ): void
    {
        if (!$contextId) {
            $context = $this->messageContextRepository->create($userId);
            $contextId = $context->id;
        }

        $this->messageRepository->create($contextId, $author, $message);
    }
}
