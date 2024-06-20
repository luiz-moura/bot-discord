<?php

namespace Domain\ChatAI\Contracts;

use Domain\ChatAI\DTOs\ChatAIQuestionData;

interface ChatAIService
{
    /**
     * @param ChatAIQuestionData[] $contextMessages
     */
    public function toAsk(ChatAIQuestionData $question, array $contextMessages = []): string;
}
