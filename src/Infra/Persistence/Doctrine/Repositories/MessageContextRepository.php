<?php

namespace Infra\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityRepository;
use Domain\Bot\Contracts\MessageContextRepository as MessageContextRepositoryContract;
use Domain\Bot\DTOs\MessageContextData;
use Infra\Persistence\Doctrine\Entities\MessageContextEntity;

class MessageContextRepository extends EntityRepository implements MessageContextRepositoryContract
{
    public function create(int $userId): MessageContextData
    {
        $message = new MessageContextEntity($userId);

        $this->getEntityManager()->persist($message);
        $this->getEntityManager()->flush();

        return new MessageContextData(
            $message->getId(),
            $message->getUserId(),
        );
    }
}
