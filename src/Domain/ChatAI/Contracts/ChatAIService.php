<?php

namespace Domain\ChatAI\Contracts;

interface ChatAIService
{
    public function toAsk(string $question): string;
}
