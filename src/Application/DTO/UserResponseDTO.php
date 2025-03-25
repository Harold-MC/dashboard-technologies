<?php

namespace App\Application\DTO;

class UserResponseDTO
{
    private string $id;
    private string $email;
    private string $phone;
    private \DateTimeImmutable $createdAt;

    /**
     *
     * @param string $id        ID único del usuario
     * @param string $email     Email del usuario
     * @param \DateTimeImmutable $createdAt Fecha/hora de creación del usuario
     */
    public function __construct(
        string $id,
        string $email,
        \DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->createdAt = $createdAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            'id'        => $this->id,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
        ];
    }
}
