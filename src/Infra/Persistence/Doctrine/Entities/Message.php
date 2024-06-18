<?php

namespace Infra\Persistence\Doctrine\Entities;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(name: 'messages')]
final class Message
{
    #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: MessageContext::class), ORM\JoinColumn(name: 'message_context_id', nullable: false)]
    private MessageContext $messageContext;

    #[ORM\Column(type: 'string')]
    private string $author;

    #[ORM\Column(type: 'string')]
    private string $content;

    #[ORM\Column(name: 'created_at', type: 'datetimetz_immutable', nullable: false)]
    private DateTimeImmutable $createdAt;

    public function __construct(MessageContext $messageContext)
    {
        $this->messageContext = $messageContext;
        $this->createdAt = new DateTimeImmutable('now');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
