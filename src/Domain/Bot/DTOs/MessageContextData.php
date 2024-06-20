<?php
namespace Domain\Bot\DTOs;

class MessageContextData
{
    public function __construct(
        public int $id,
        public int $userId
    ) {
    }
}
