<?php

use Doctrine\ORM\EntityManagerInterface;
use Domain\Bot\Contracts\BotService as BotServiceContract;
use Domain\Bot\Contracts\MessageContextRepository as MessageContextRepositoryContract;
use Domain\Bot\Contracts\MessageRepository as MessageRepositoryContract;
use Domain\Bot\Contracts\UserRepository as UserRepositoryContract;
use Domain\ChatAI\Contracts\ChatAIService;
use Infra\Bot\Discord\DiscordService;
use Infra\ChatAI\ChatGPT\ChatGptService;
use Infra\Persistence\Doctrine\Entities\MessageEntity;
use Infra\Persistence\Doctrine\Entities\MessageContextEntity;
use Infra\Persistence\Doctrine\Entities\UserEntity;
use Psr\Container\ContainerInterface;

return [
    /** Contracts */
    ChatAIService::class => \DI\autowire(ChatGptService::class),
    BotServiceContract::class => \DI\autowire(DiscordService::class),

    /** Repositories */
    UserRepositoryContract::class => function (ContainerInterface $container) {
        return $container->get(EntityManagerInterface::class)->getRepository(UserEntity::class);
    },
    MessageRepositoryContract::class => function (ContainerInterface $container) {
        return $container->get(EntityManagerInterface::class)->getRepository(MessageEntity::class);
    },
    MessageContextRepositoryContract::class => function (ContainerInterface $container) {
        return $container->get(EntityManagerInterface::class)->getRepository(MessageContextEntity::class);
    },
];
