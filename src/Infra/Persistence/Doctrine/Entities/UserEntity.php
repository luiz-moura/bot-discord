<?php

namespace Infra\Persistence\Doctrine\Entities;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Infra\Persistence\Doctrine\Repositories\UserRepository;

#[ORM\Entity(repositoryClass: UserRepository::class), ORM\Table(name: 'users')]
class UserEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(
        name: 'discord_id',
        type: 'integer',
    )]
    private int $discordId;

    #[ORM\Column(type: 'string')]
    private string $nickname;

    #[ORM\Column(
        name: 'registered_at',
        type: 'datetimetz_immutable',
    )]
    private $registeredAt;

    #[ORM\OneToMany(targetEntity: MessageContextEntity::class, mappedBy: 'users')]
    private $messageContexts;

    public function __construct(
        string $nickname,
        int $discordId,
    ) {
        $this->nickname = $nickname;
        $this->discordId = $discordId;
        $this->registeredAt = new DateTimeImmutable('now');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function getDiscordId(): int
    {
        return $this->discordId;
    }
}
