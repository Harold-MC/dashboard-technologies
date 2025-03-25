<?php

namespace App\Application\UseCase;

use App\Application\DTO\RegisterUserRequest;
use App\Application\DTO\UserResponseDTO;
use App\Application\EventDispatcherInterface;
use App\Domain\Entity\User;
use App\Domain\Event\UserRegisteredEvent;
use App\Domain\Exception\UserAlreadyExistsException;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\Phone;
use App\Domain\ValueObject\UserId;

class RegisterUserUseCase
{
    private UserRepositoryInterface $userRepository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function execute(RegisterUserRequest $request): UserResponseDTO
    {
        $emailVO = new Email($request->getEmail());
        $phoneVO = new Phone($request->getPhone());

        $existingUser = $this->userRepository->findByEmail($emailVO);
        
        if ($existingUser !== null) {
            throw new UserAlreadyExistsException(
                "El email ya está en uso: " . $request->getEmail()
            );
        }

        $user = new User(
            new UserId(),
            new Name($request->getName()),
            $emailVO,
            $phoneVO,
            new Password($request->getPassword())
        );

        $this->userRepository->save($user);

        $event = new UserRegisteredEvent(
            $user->id()->value(),
            $user->name()->value(),
            $user->email()->value()
        );
        $this->eventDispatcher->dispatch($event);

        return new UserResponseDTO(
            $user->id()->value(),
            $user->email()->value(),
            $user->createdAt()
        );
    }
}
