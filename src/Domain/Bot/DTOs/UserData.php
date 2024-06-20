<?php
namespace Domain\Bot\DTOs;

class UserData
{
    public function __construct(
        public int $id,
        public int $discordId,
        public string $nickname,
    ) {
    }
}
