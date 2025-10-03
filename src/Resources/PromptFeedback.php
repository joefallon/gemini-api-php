<?php

declare(strict_types=1);

namespace GeminiAPI\Resources;

use GeminiAPI\Enums\BlockReasonEnum;
use GeminiAPI\Traits\ArrayTypeValidator;
use JsonSerializable;

class PromptFeedback implements JsonSerializable
{
    use ArrayTypeValidator;

    public ?BlockReasonEnum $blockReason;
    public array            $safetyRatings;

    /**
     * @param ?BlockReasonEnum $blockReason
     * @param SafetyRating[]   $safetyRatings
     */
    public function __construct(
        ?BlockReasonEnum $blockReason,
        array            $safetyRatings
    ) {
        $this->blockReason = $blockReason;
        $this->safetyRatings = $safetyRatings;
        $this->ensureArrayOfType($safetyRatings, SafetyRating::class);
    }

    /**
     * @param array{
     *     blockReason: string|null,
     *     safetyRatings?: array<int, array{category: string, probability: string, blocked?: bool|null}>
     * } $array
     *
     * @return self
     */
    public static function fromArray(array $array): self
    {
        $blockReason = null;
        if (isset($array['blockReason']) && $array['blockReason'] !== '') {
            $blockReason = BlockReasonEnum::from($array['blockReason']);
        }
        $safetyRatings = array_map(
            static fn(array $rating): SafetyRating => SafetyRating::fromArray($rating),
            $array['safetyRatings'] ?? [],
        );

        return new self($blockReason, $safetyRatings);
    }

    /**
     * @return array<string, string|array<string, mixed>>
     */
    public function jsonSerialize(): array
    {
        $arr = [];

        if($this->blockReason)
        {
            $arr['blockReason'] = $this->blockReason->value;
        }

        if(!empty($this->safetyRatings))
        {
            $arr['safetyRatings'] = $this->safetyRatings;
        }

        return $arr;
    }
}
