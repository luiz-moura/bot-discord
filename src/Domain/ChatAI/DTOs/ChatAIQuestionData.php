<?php

namespace Domain\ChatAI\DTOs;

use Domain\ChatAI\Enums\MessageRolesEnum;

class ChatAIQuestionData
{
    public function __construct(
        public MessageRolesEnum $role,
        public string $content,
    ) {
    }
}
