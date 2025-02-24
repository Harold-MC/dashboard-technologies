<?php

namespace Tests\Unit\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\UserId;
use App\Domain\Exception\InvalidUserIdException;

class UserIdTest extends TestCase
{
    public function testValidUserId(): void
    {
        $uuid = '123e4567-e89b-12d3-a456-426614174000';
        $userId = new UserId($uuid);
        $this->assertEquals($uuid, $userId->value());
    }

    public function testInvalidUserIdThrowsException(): void
    {
        $this->expectException(InvalidUserIdException::class);
        new UserId('not-a-valid-uuid');
    }
}
