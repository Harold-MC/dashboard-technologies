<?php

namespace App\Application\DTO;

class RegisterUserRequest
{
    private string $name;
    private string $email;
    private string $phone;
    private string $password;

    public function __construct(
        string $name,
        string $email,
        string $phone,
        string $password
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
