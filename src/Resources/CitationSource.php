<?php

declare(strict_types=1);

namespace GeminiAPI\Resources;

use JsonSerializable;

class CitationSource implements JsonSerializable
{
    public ?int    $startIndex;
    public ?int    $endIndex;
    public ?string $uri;
    public ?string $license;

    public function __construct(
        ?int    $startIndex,
        ?int    $endIndex,
        ?string $uri,
        ?string $license
    ) {
        $this->startIndex = $startIndex;
        $this->endIndex = $endIndex;
        $this->uri = $uri;
        $this->license = $license;
    }

    /**
     * @param array{
     *     startIndex?: int|null,
     *     endIndex?: int|null,
     *     uri?: string|null,
     *     license?: string|null,
     * } $source
     *
     * @return self
     */
    public static function fromArray(array $source): self
    {
        return new self(
            $source['startIndex'] ?? null,
            $source['endIndex'] ?? null,
            $source['uri'] ?? null,
            $source['license'] ?? null,
        );
    }

    /**
     * @return array{
     *     startIndex?: int|null,
     *     endIndex?: int|null,
     *     uri?: string|null,
     *     license?: string|null,
     * }
     */
    public function jsonSerialize(): array
    {
        return array_filter(get_object_vars($this), static fn($v) => !is_null($v));
    }
}
