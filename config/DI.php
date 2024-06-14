<?php

use Domain\Bot\Contracts\BotService;
use Domain\ChatAI\Contracts\ChatAIService;
use Infra\Bot\Discord\DiscordService;
use Infra\ChatAI\ChatGPT\ChatGptService;

return [
    ChatAIService::class => \DI\autowire(ChatGptService::class),
    BotService::class => \DI\autowire(DiscordService::class),
];
