<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Application\UseCase\RegisterUserUseCase;
use App\Infrastructure\Persistence\Doctrine\Repository\DoctrineUserRepository;
use App\Infrastructure\EventDispatcher\SimpleEventDispatcher;
use App\Infrastructure\Controller\RegisterUserController;

$entityManager = \App\Infrastructure\Persistence\Doctrine\DoctrineConfig::getEntityManager();

$userRepository = new DoctrineUserRepository($entityManager);

$eventDispatcher = new SimpleEventDispatcher();

$registerUserUseCase = new RegisterUserUseCase($userRepository, $eventDispatcher);

$registerUserController = new RegisterUserController($registerUserUseCase);

$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($route === '/register' && $method === 'POST') {
    $rawBody = file_get_contents('php://input');

    $payload = json_decode($rawBody, true);

    $registerUserController->register($payload);
    
} else {
    http_response_code(404);
    echo "Not Found";
}
