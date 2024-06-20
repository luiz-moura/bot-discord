<?php

namespace Domain\Bot\Actions;

use Domain\Bot\Contracts\MessageRepository;

class QueryMessagesFromLastContextByUserIdAction
{
    public function __construct(private MessageRepository $messageRepository) {
    }

    /**
     * @return \Domain\Bot\DTOs\MessageData[]
     */
    public function __invoke(int $userId): array
    {
        return $this->messageRepository->queryMessagesFromLastContextByUserId($userId);
    }
}
