<?php

$container = require __DIR__ . '/../bootstrap/app.php';

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Intents;
use Discord\WebSockets\Event;
use Infra\Bot\Discord\DiscordService;

$botService = $container->get(DiscordService::class);

$discord = new Discord([
    'token' => $_ENV['DISCORD_TOKEN'],
    'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT,
]);

$discord->on(Event::READY, function (Discord $discord) use ($botService) {
    echo "Bot is ready!", PHP_EOL;

    $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) use ($botService) {
        echo "{$message->author->username}: {$message->content}", PHP_EOL;

        $botService->reply($message);
    });
});

$discord->run();