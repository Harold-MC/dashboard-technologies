<?php

namespace App\Domain\Event;

class UserRegisteredEvent implements DomainEvent
{
    private string $userId;
    private string $userName;
    private string $userEmail;
    private \DateTimeImmutable $occurredOn;

    public function __construct(string $userId, string $userName, string $userEmail)
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function userEmail(): string
    {
        return $this->userEmail;
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
