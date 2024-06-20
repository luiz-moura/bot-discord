<?php

namespace Domain\Bot\Contracts;

use Domain\Bot\DTOs\UserData;

interface UserRepository
{
    public function findByDiscordId(int $discordId): ?UserData;
    public function create(string $nickname, int $discordId): UserData;
}
