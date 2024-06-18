<?php

namespace Infra\ChatAI\ChatGPT;

use Domain\ChatAI\Contracts\ChatAIService as ChatAIServiceContract;
use OpenAI;
use OpenAI\Client;

class ChatGptService implements ChatAIServiceContract
{
    private Client $openaiClient;
    private string $model;

    public function __construct()
    {
        $this->openaiClient = OpenAI::client(config('chatgpt.token'));
        $this->model = config('chatgpt.model');
    }

    public function toAsk(string $question): string
    {
        $result = $this->openaiClient->chat()->create([
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $question
                ],
            ],
        ]);

        return $result->choices[0]->message->content;
    }
}
