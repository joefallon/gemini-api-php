<?php

declare(strict_types=1);

namespace GeminiAPI\Resources\Parts;

use GeminiAPI\Enums\MimeTypeEnum;
use JsonSerializable;

use function json_encode;

class FilePart implements PartInterface, JsonSerializable
{
    public string $mimeType;
    public string   $data;

    public function __construct(
        string $mimeType,
        string   $data
    ) {
        $this->mimeType = $mimeType;
        $this->data = $data;
    }

    /**
     * @return array{
     *     inlineData: array{
     *         mimeType: string,
     *         data: string,
     *     },
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'inlineData' => [
                'mimeType' => $this->mimeType,
                'data'     => $this->data,
            ],
        ];
    }

    public function __toString(): string
    {
        return json_encode($this) ?: '';
    }
}
