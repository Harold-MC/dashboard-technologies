<?php

namespace App\Domain\Exception;

use DomainException;

class InvalidNameException extends DomainException
{
    public function __construct(string $message = "")
    {
        if (empty($message)) {
            $message = "El nombre es inválido.";
        }

        parent::__construct($message);
    }
}
