<?php

namespace App\Domain\Exception;

use DomainException;

class InvalidEmailException extends DomainException
{
    public function __construct(string $message = "")
    {
        if (empty($message)) {
            $message = "El formato de email es inválido.";
        }

        parent::__construct($message);
    }
}
