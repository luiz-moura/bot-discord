<?php

namespace Domain\Bot\Enums;

enum BotCommandsEnum: string
{
    case RESET = 'reset context';
    case HELP = 'help';
}
