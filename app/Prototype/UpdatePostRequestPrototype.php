<?php

namespace App\Prototype;

class UpdatePostRequestPrototype extends PostRequestPrototype
{
    private int $id;

    public static function fromRequest(array $data): self
    {
        $instance = new self();
        $instance->content = $data['content'];
        $instance->title = $data['title'] ?? null;
        $instance->id = $data['id'];

        return $instance;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
