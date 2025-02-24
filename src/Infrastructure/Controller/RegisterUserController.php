<?php

namespace App\Infrastructure\Controller;

use App\Application\UseCase\RegisterUserUseCase;
use App\Application\DTO\RegisterUserRequest;
use App\Domain\Exception\UserAlreadyExistsException;
use App\Domain\Exception\InvalidEmailException;
use App\Domain\Exception\WeakPasswordException;
use DomainException;
use Throwable;

class RegisterUserController
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function register(array $requestData): void
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $registerUserRequest = new RegisterUserRequest(
                $requestData['name'] ?? '',
                $requestData['email'] ?? '',
                $requestData['password'] ?? ''
            );

            $userResponseDTO = $this->registerUserUseCase->execute($registerUserRequest);

            echo json_encode([
                'success' => true,
                'user' => [
                    'id' => $userResponseDTO->getId(),
                    'email' => $userResponseDTO->getEmail(),
                    'createdAt' => $userResponseDTO->getCreatedAt()->format('Y-m-d H:i:s')
                ]
            ]);
        }
        catch (InvalidEmailException|WeakPasswordException|UserAlreadyExistsException $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage(),
            ]);
        }
        catch (DomainException $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage(),
            ]);
        }
        catch (Throwable $e) {
            var_dump($e->getMessage());
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Ha ocurrido un error inesperado.',
            ]);
        }
    }
}
