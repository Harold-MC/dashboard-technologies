<?php

namespace Tests\Unit\Domain\Entity;

use PHPUnit\Framework\TestCase;
use App\Domain\Entity\User;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Password;

class UserTest extends TestCase
{
    public function testUserCreation(): void
    {
        $user = new User(
            new UserId('12345'),
            new Name('John Doe'),
            new Email('john.doe@example.com'),
            new Password('MyStr0ngPass!')
        );

        $this->assertSame('12345', $user->id()->value());
        $this->assertSame('John Doe', $user->name()->value());
        $this->assertSame('john.doe@example.com', $user->email()->value());
        $this->assertNotNull($user->createdAt());
    }
}
