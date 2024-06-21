<?php

namespace Infra\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Domain\Bot\Contracts\MessageRepository as MessageRepositoryContract;
use Domain\Bot\DTOs\MessageData;
use Domain\ChatAI\Enums\MessageRolesEnum;
use Infra\Persistence\Doctrine\Entities\MessageEntity;

class MessageRepository extends EntityRepository implements MessageRepositoryContract
{
    public function create(int $contextId, MessageRolesEnum $author, string $message): MessageData
    {
        $message = new MessageEntity($contextId, $author, $message);

        $this->getEntityManager()->persist($message);
        $this->getEntityManager()->flush();

        return new MessageData(
            $message->getMessageContextId(),
            $message->getAuthor(),
            $message->getContent(),
        );
    }

    public function queryMessagesFromLastContextByUserId(int $userId): array
    {
        $sql = "
            SELECT m.*
            FROM messages m
            JOIN (
                SELECT
                    c.*,
                    ROW_NUMBER() OVER (PARTITION BY c.user_id ORDER BY c.created_at DESC) AS rownumber
                FROM message_contexts c
                WHERE c.user_id = :user_id
            ) c2 ON m.message_context_id = c2.id
            WHERE c2.rownumber = 1
        ";

        $rsm = (new ResultSetMapping())
            ->addScalarResult('id', 'id')
            ->addScalarResult('author', 'author')
            ->addScalarResult('content', 'content')
            ->addScalarResult('created_at', 'created_at')
            ->addScalarResult('message_context_id', 'message_context_id');

        $messages = $this->getEntityManager()
            ->createNativeQuery($sql, $rsm)
            ->setParameter('user_id', $userId)
            ->getResult();

        return array_map(fn ($message) => new MessageData(
            $message['message_context_id'],
            $message['author'],
            $message['content'],
        ), $messages);
    }
}
