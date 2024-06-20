<?php

namespace Infra\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityRepository;
use Domain\Bot\Contracts\UserRepository as UserRepositoryContract;
use Domain\Bot\DTOs\UserData;
use Infra\Persistence\Doctrine\Entities\UserEntity;

class UserRepository extends EntityRepository implements UserRepositoryContract
{
    public function create(string $nickname, int $discordId): UserData
    {
        $user = new UserEntity($nickname, $discordId);

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return new UserData(
            $user->getId(),
            $user->getDiscordId(),
            $user->getNickname(),
        );
    }

    public function findByDiscordId(int $discordId): ?UserData
    {
        $user = $this->findOneBy(['discordId' => $discordId]);

        if (!$user) {
            return null;
        }

        return new UserData(
            $user->getId(),
            $user->getDiscordId(),
            $user->getNickname(),
        );
    }
}
