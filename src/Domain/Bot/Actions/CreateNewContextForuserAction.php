<?php

namespace Domain\Bot\Actions;

use Domain\Bot\Contracts\MessageContextRepository;
use Domain\Bot\DTOs\MessageContextData;

class CreateNewContextForUserAction
{
    public function __construct(private MessageContextRepository $messageContextRepository) {
    }

    public function __invoke(int $userId): MessageContextData
    {
        return $this->messageContextRepository->create($userId);
    }
}
