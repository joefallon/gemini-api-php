<?php

declare(strict_types=1);

namespace GeminiAPI\Resources\Parts;

use JsonSerializable;

use function json_encode;

class TextPart implements PartInterface, JsonSerializable
{
    public string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return array{
     *     text: string,
     * }
     */
    public function jsonSerialize(): array
    {
        return ['text' => $this->text];
    }

    public function __toString(): string
    {
        return json_encode($this) ?: '';
    }
}
