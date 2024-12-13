<?php

namespace Sthom\App\Model;

class User
{
    public const TABLE = 'user';

    private ?int    $id;
    private ?string $name;
    private ?string $email;
    private ?string $password;
    private ?string $roles;

    private ?\DateTimeImmutable $created_at = null;

    public function getId(): int
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function setRoles(array $roles): void
    {
        // on récupère le tableau et on le sérialise avant insertion dans la base de données
        $serializedRoles = json_encode($roles);
        // dd($serializedRoles);
        $this->roles = $serializedRoles;
    }

    public function addRole(string $role): void
    {
        // on déserialise la chaîne de caractères
        $roles = unserialize($this->roles);
        $roles[] = $role;
        $serializedRoles = serialize($roles);
        $this->roles = $serializedRoles;
    }

    public function getRoles(): array
    {
        return unserialize($this->roles);
    }


}

