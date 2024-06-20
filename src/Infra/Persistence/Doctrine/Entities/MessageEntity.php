<?php

namespace Infra\Persistence\Doctrine\Entities;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Domain\ChatAI\Enums\MessageRolesEnum;
use Infra\Persistence\Doctrine\Repositories\MessageRepository;

#[ORM\Entity(repositoryClass: MessageRepository::class), ORM\Table(name: 'messages')]
final class MessageEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(
        name: 'message_context_id',
        type: 'integer',
    )]
    private int $messageContextId;

    #[ORM\Column(type: 'string')]
    private string $author;

    #[ORM\Column(type: 'string')]
    private string $content;

    #[ORM\Column(
        name: 'created_at',
        type: 'datetimetz_immutable',
    )]
    private DateTimeImmutable $createdAt;

    // #[ORM\ManyToOne(targetEntity: MessageContextEntity::class)]
    // #[ORM\JoinColumn(
    //     name: 'message_context_id',
    //     nullable: false,
    // )]
    private MessageContextEntity $messageContext;

    public function __construct(
        int $messageContextId,
        MessageRolesEnum $author,
        string $content,
    ) {
        $this->messageContextId = $messageContextId;
        $this->author = $author->value;
        $this->content = $content;
        $this->createdAt = new DateTimeImmutable('now');
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getMessageContextId(): int
    {
        return $this->messageContextId;
    }
}
