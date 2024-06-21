<?php

$container = require __DIR__ . '/../bootstrap/app.php';

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Intents;
use Discord\WebSockets\Event;
use Domain\Bot\UseCases\ReplyMessageUseCase;

$replyMessageUseCase = $container->get(ReplyMessageUseCase::class);

$discord = new Discord([
    'token' => config('discord.token'),
    'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT,
]);

$discord->on('ready', function (Discord $discord) use ($replyMessageUseCase) {
    echo "Bot is ready!", PHP_EOL;

    $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) use ($replyMessageUseCase) {
        echo "{$message->author->username}: {$message->content}", PHP_EOL;

        ($replyMessageUseCase)($message, $discord);
    });
});

$discord->run();
