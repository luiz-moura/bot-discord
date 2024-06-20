<?php

namespace Domain\ChatAI\Actions;

use Domain\ChatAI\Enums\MessageRolesEnum;
use Domain\ChatAI\Contracts\ChatAIService;
use Domain\ChatAI\DTOs\ChatAIQuestionData;

class ToAskAction
{
    public function __construct(private ChatAIService $chatAIService) {
    }

    /**
     * @param ChatAIQuestionData[] $contextMessages
     */
    public function __invoke(string $question, array $contextMessages = []): string
    {
        $question = new ChatAIQuestionData(
            MessageRolesEnum::USER,
            $question,
        );

        return $this->chatAIService->toAsk($question, $contextMessages);
    }
}
