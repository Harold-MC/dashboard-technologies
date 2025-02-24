<?php

namespace App\Domain\Exception;

use DomainException;

class InvalidUserIdException extends DomainException
{
    public function __construct(string $message = "")
    {
        if (empty($message)) {
            $message = "El ID del usuario es inválido.";
        }

        parent::__construct($message);
    }
}
