<?php

namespace Infra\Persistence\Doctrine\Entities;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Infra\Persistence\Doctrine\Repositories\MessageContextRepository;

#[ORM\Entity(repositoryClass: MessageContextRepository::class), ORM\Table(name: 'message_contexts')]
final class MessageContextEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(
        name: 'user_id',
        type: 'integer',
    )]
    private int $userId;

    #[ORM\Column(
        name: 'created_at',
        type: 'datetimetz_immutable',
    )]
    private DateTimeImmutable $createdAt;

    // #[ORM\ManyToOne(targetEntity: UserEntity::class)]
    // #[ORM\JoinColumn(nullable: false)]
    // private UserEntity $user;

    public function __construct(
        int $userId
    ) {
        $this->userId = $userId;
        $this->createdAt = new DateTimeImmutable('now');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
