<?php

namespace Src\Discord;

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Intents;
use Discord\WebSockets\Event;

class BotDiscord
{
    public function __invoke()
    {
        $discord = new Discord([
            'token' => $_ENV['DISCORD_TOKEN'],
            'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT,
        ]);

        $discord->on('ready', function (Discord $discord) {
            echo "Bot is ready!", PHP_EOL;

            $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) {
                echo "{$message->author->username}: {$message->content}", PHP_EOL;

                if ($message->author->bot) {
                    return;
                }

                if ($message->content == 'ping') {
                    $message->reply('pong');
                }
            });
        });

        $discord->run();
    }
}

(new BotDiscord)();
