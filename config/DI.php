<?php

use Domain\ChatAI\Contracts\ChatAIService;
use Infra\ChatAI\ChatGPT\ChatGptService;

return [
    ChatAIService::class => \DI\autowire(ChatGptService::class),
];
