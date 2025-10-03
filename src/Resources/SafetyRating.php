<?php

declare(strict_types=1);

namespace GeminiAPI\Resources;

use GeminiAPI\Enums\HarmCategoryEnum;
use GeminiAPI\Enums\HarmProbabilityEnum;
use JsonSerializable;

class SafetyRating implements JsonSerializable
{
    public string $category;
    public string $probability;
    public ?bool           $blocked;

    public function __construct(
        string $category,
        string $probability,
        ?bool           $blocked
    ) {
        $this->category = $category;
        $this->probability = $probability;
        $this->blocked = $blocked;
    }

    /**
     * @param array{
     *     category: string,
     *     probability: string,
     *     blocked?: bool|null,
     * } $array
     *
     * @return self
     */
    public static function fromArray(array $array): self
    {
        $category = HarmCategoryEnum::from($array['category']);
        $probability = HarmProbabilityEnum::from($array['probability']);
        $blocked = $array['blocked'] ?? null;

        return new self($category, $probability, $blocked);
    }

    /**
     * @return array<string, bool|string>
     */
    public function jsonSerialize(): array
    {
        $arr = [
            'category'    => $this->category->value,
            'probability' => $this->probability->value,
        ];

        if($this->blocked !== null)
        {
            $arr['blocked'] = $this->blocked;
        }

        return $arr;
    }
}
