<?php

namespace Infra\ChatAI\ChatGPT;

use Domain\ChatAI\Contracts\ChatAIService as ChatAIServiceContract;
use Domain\ChatAI\DTOs\ChatAIQuestionData;
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

    public function toAsk(ChatAIQuestionData $question, array $contextMessages = []): string
    {
        $response = $this->openaiClient->chat()->create([
            'model' => $this->model,
            'messages' => [
                ...$contextMessages,
                $question
            ]
        ]);

        return $response->choices[0]->message->content;
    }
}
