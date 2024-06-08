<?php

namespace Src\ChatGPT;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ChatGpt
{
    public function ask(string $question): string
    {
        $url = $_ENV['CHATGPT_URI'];
        $model = $_ENV['CHATGPT_MODEL'];
        $token = $_ENV['CHATGPT_TOKEN'];

        $client = new Client();

        $data = [
            'model' => $model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are ChatGPT, a large language model trained by OpenAI.'
                ],
                [
                    'role' => 'system',
                    'content' => 'Answer in less than 1000 characters.'
                ],
                [
                    'role' => 'user',
                    'content' => $question
                ]
            ]
        ];

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ]);

            $responseBody = json_decode($response->getBody(), true);

            return $responseBody['choices'][0]['message']['content'];
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return 'Erro na chamada da API: ' . $e->getResponse()->getBody()->getContents();
            }

            return 'Erro na chamada da API: ' . $e->getMessage();
        }
    }
}
