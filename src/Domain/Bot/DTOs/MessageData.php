<?php
namespace Domain\Bot\DTOs;

class MessageData
{
    public function __construct(
        public int $contextId,
        public string $author,
        public string $content,
    ) {
    }
}
