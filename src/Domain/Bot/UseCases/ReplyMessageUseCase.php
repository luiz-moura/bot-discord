<?php

namespace Domain\Bot\UseCases;

use Domain\Bot\Actions\FindOrCreateUserAction;
use Domain\Bot\Actions\QueryMessagesFromLastContextByUserIdAction;
use Domain\Bot\Actions\RunCommandsAction;
use Domain\Bot\Actions\StoreMessageAction;
use Domain\Bot\Contracts\BotService;
use Domain\Bot\DTOs\MessageData;
use Domain\Bot\Enums\BotCommandsEnum;
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
        private RunCommandsAction $runCommandsAction,
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
        if ($user->isNewUser) {
            $message =($this->runCommandsAction)(BotCommandsEnum::from($bot->getMessageContent()), $user->id);

            return;
        }

        $isCommand = in_array($bot->getMessageContent(), array_column(BotCommandsEnum::cases(), 'value'));
        if ($isCommand) {
            $message = ($this->runCommandsAction)(BotCommandsEnum::from($bot->getMessageContent()), $user->id);

            $this->botService->reply($message);

            return;
        }

        $contextMessages = ($this->queryMessagesFromLastContextByUserIdAction)($user->id);
        $messages = array_map(fn (MessageData $message) => new ChatAIQuestionData(
            MessageRolesEnum::from($message->author),
            $message->content
        ), $contextMessages);

        $aiAnswer = ($this->toAskAction)($bot->getMessageContent(), $messages);
        $contextId = $contextMessages[0]->contextId ?? null;

        ($this->storeMessageAction)(
            $user->id,
            MessageRolesEnum::USER,
            $bot->getMessageContent(),
            $contextId
        );

        $this->botService->reply($aiAnswer);

        ($this->storeMessageAction)(
            $user->id,
            MessageRolesEnum::ASSISTANT,
            $aiAnswer,
            $contextId
        );
    }
}
