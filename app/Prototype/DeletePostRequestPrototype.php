<?php

namespace App\Prototype;

class DeletePostRequestPrototype
{
    private int $id;

    public static function fromRequest(array $data): self
    {
        $instance = new self();
        $instance->id = $data['id'];

        return $instance;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
