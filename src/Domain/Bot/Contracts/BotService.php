<?php

namespace Domain\Bot\Contracts;

interface BotService
{
    public function reply($mensseger): void;
}
