<?php

namespace Domain\Bot\Contracts;

use Domain\Bot\DTOs\MessageContextData;

interface MessageContextRepository
{
    public function create(int $userId): MessageContextData;
}
