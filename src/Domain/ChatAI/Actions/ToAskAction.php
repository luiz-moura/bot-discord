<?php

namespace Domain\ChatAI\Actions;

use Domain\ChatAI\Contracts\ChatAIService;

class ToAskAction
{
    public function __construct(private ChatAIService $chatAIService)
    {
    }

    public function __invoke(string $question): string
    {
        return $this->chatAIService->toAsk(...func_get_args());
    }
}
