<?php

namespace App\Prototype;

class PostRequestPrototype
{
    protected string $content;
    protected ?string $title;
    public static function fromRequest(array $data): self
    {
        $instance = new self();
        $instance->content = $data['content'];
        $instance->title = $data['title'] ?? null;

        return $instance;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
