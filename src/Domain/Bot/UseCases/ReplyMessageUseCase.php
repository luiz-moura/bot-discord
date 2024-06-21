<?php

namespace Domain\Bot\UseCases;

use Domain\Bot\Actions\FindOrCreateUserAction;
use Domain\Bot\Actions\QueryMessagesFromLastContextByUserIdAction;
use Domain\Bot\Actions\StoreMessageAction;
use Domain\Bot\Contracts\BotService;
use Domain\Bot\DTOs\MessageData;
use Domain\ChatAI\Enums\MessageRolesEnum;
use Domain\ChatAI\Actions\ToAskAction;
use Domain\ChatAI\DTOs\ChatAIQuestionData;

class ReplyMessageUseCase
{
    public function __construct(
        private FindOrCreateUserAction $findOrCreateUserAction,
        private QueryMessagesFromLastContextByUserIdAction $queryMessagesFromLastContextByUserIdAction,
        private StoreMessageAction $storeMessageAction,
        private ToAskAction $toAskAction,
        private BotService $botService
    ) {
    }

    public function __invoke(object $message, object $discord): void
    {
        $bot = $this->botService
            ->setMessage($message)
            ->setBot($discord);

        if ($bot->messageAuthorIsBot() || $bot->botNotMentioned()) {
            return;
        }

        $user = ($this->findOrCreateUserAction)($bot->getUserName(), $bot->getMessageUserId());

        $contextMessages = ($this->queryMessagesFromLastContextByUserIdAction)($user->id);

        $messages = array_map(fn (MessageData $message) => new ChatAIQuestionData(
            MessageRolesEnum::from($message->author),
            $message->content
        ), $contextMessages);

        $aiResponse = ($this->toAskAction)($bot->getMessageContent(), $messages);
        $contextId = $contextMessages[0]->contextId ?? null;

        ($this->storeMessageAction)(
            $user->id,
            MessageRolesEnum::USER,
            $bot->getMessageContent(),
            $contextId
        );

        $this->botService->reply($aiResponse);

        ($this->storeMessageAction)(
            $user->id,
            MessageRolesEnum::ASSISTANT,
            $aiResponse,
            $contextId
        );
    }
}
