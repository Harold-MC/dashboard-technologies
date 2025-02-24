<?php

namespace Tests\Unit\Application\UseCase;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use App\Application\UseCase\RegisterUserUseCase;
use App\Application\DTO\RegisterUserRequest;
use App\Application\DTO\UserResponseDTO;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Entity\User;
use App\Domain\Event\UserRegisteredEvent;
use App\Domain\Exception\UserAlreadyExistsException;
use App\Domain\ValueObject\Email;
use App\Application\EventDispatcherInterface;

class RegisterUserUseCaseTest extends TestCase
{
    /**
     * @var UserRepositoryInterface|MockObject
     */
    private $userRepository;

    /**
     * @var EventDispatcherInterface|MockObject
     */
    private $eventDispatcher;

    private RegisterUserUseCase $useCase;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);

        $this->useCase = new RegisterUserUseCase(
            $this->userRepository,
            $this->eventDispatcher
        );
    }

    public function testRegisterUserAlreadyExistsThrowsException(): void
    {
        $existingUser = $this->createMock(User::class);
        $this->userRepository->expects($this->once())
            ->method('findByEmail')
            ->with($this->isInstanceOf(Email::class))
            ->willReturn($existingUser);

        $this->expectException(UserAlreadyExistsException::class);

        $request = new RegisterUserRequest('John Doe', 'john@example.com', 'Secret123!');

        $this->useCase->execute($request);
    }

    public function testSuccessfulRegistration(): void
    {
        $this->userRepository->expects($this->once())
            ->method('findByEmail')
            ->with($this->isInstanceOf(Email::class))
            ->willReturn(null);

        $this->userRepository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(User::class));

        $this->eventDispatcher->expects($this->once())
            ->method('dispatch')
            ->with($this->isInstanceOf(UserRegisteredEvent::class));

        $request = new RegisterUserRequest('John Doe', 'john@example.com', 'Secret123!');

        $response = $this->useCase->execute($request);

        $this->assertInstanceOf(UserResponseDTO::class, $response);
        $this->assertEquals('john@example.com', $response->getEmail());
    }
}
