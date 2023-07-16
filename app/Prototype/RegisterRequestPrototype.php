<?php

namespace App\Prototype;

class RegisterRequestPrototype
{
    public string $name;
    public string $password;
    public string $email;
    public string $phone;

    public static function fromRequest(array $data): self
    {
        $instance = new self();
        $instance->name = $data['name'];
        $instance->password = $data['password'];
        $instance->email = $data['email'];
        $instance->phone = $data['phone'];

        return $instance;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
