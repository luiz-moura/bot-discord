<?php

namespace Domain\ChatAI\Enums;

enum MessageRolesEnum: string
{
    case ASSISTANT = 'assistant';
    case USER = 'user';
    case SYSTEM = 'system';
}
