<?php

declare(strict_types=1);

namespace GeminiAPI;

use GeminiAPI\Enums\HarmBlockThreshold;
use GeminiAPI\Enums\HarmCategory;
use JsonSerializable;

use function json_encode;

class SafetySetting implements JsonSerializable
{
    /** @var string */
    public $category;
    /** @var string */
    public $threshold;

    public function __construct(
        string $category,
        string $threshold
    ) {
        $this->category = $category;
        $this->threshold = $threshold;
    }

    /**
     * @return array{
     *     category: string,
     *     threshold: string,
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'category' => $this->category->value,
            'threshold' => $this->threshold->value,
        ];
    }

    public function __toString()
    {
        return json_encode($this) ?: '';
    }
}
