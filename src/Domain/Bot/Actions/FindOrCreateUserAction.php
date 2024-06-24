<?php

namespace Domain\Bot\Actions;

use Domain\Bot\Contracts\UserRepository;
use Domain\Bot\DTOs\UserData;

class FindOrCreateUserAction
{
    public function __construct(private UserRepository $userRepository) {
    }

    public function __invoke(string $nickname, int $discordId): UserData
    {
        $user = $this->userRepository->findByDiscordId($discordId);

        if (!$user) {
            $user = $this->userRepository->create($nickname, $discordId);
            $user->isNewUser = true;
        }

        return $user;
    }
}
