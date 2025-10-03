<?php

declare(strict_types=1);

namespace GeminiAPI\Resources;

use GeminiAPI\Enums\FinishReasonEnum;
use GeminiAPI\Enums\RoleEnum;
use GeminiAPI\Traits\ArrayTypeValidator;
use UnexpectedValueException;

class Candidate implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [
            'content' => $this->content,
            'finishReason' => $this->finishReason,
            'citationMetadata' => $this->citationMetadata,
            'safetyRatings' => $this->safetyRatings,
            'tokenCount' => $this->tokenCount,
            'index' => $this->index,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this) ?: '';
    }
    use ArrayTypeValidator;

    public Content          $content;
    public string $finishReason;
    public CitationMetadata $citationMetadata;
    public array            $safetyRatings;
    public int              $tokenCount;
    public int              $index;

    /**
     * @param Content          $content
     * @param FinishReasonEnum $finishReason
     * @param CitationMetadata $citationMetadata
     * @param SafetyRating[]   $safetyRatings
     * @param int              $tokenCount
     * @param int              $index
     */
    public function __construct(
        Content          $content,
        string $finishReason,
        CitationMetadata $citationMetadata,
        array            $safetyRatings,
        int              $tokenCount,
        int              $index
    ) {
        $this->content = $content;
        $this->finishReason = $finishReason;
        $this->citationMetadata = $citationMetadata;
        $this->safetyRatings = $safetyRatings;
        $this->tokenCount = $tokenCount;
        $this->index = $index;

        if($tokenCount < 0)
        {
            throw new UnexpectedValueException('tokenCount cannot be negative');
        }

        if($index < 0)
        {
            throw new UnexpectedValueException('index cannot be negative');
        }

        $this->ensureArrayOfType($safetyRatings, SafetyRating::class);
    }

    /**
     * @param array{
     *     citationMetadata: array{citationSources: array<int, array{startIndex?: int|null, endIndex?:
     *     int|null, uri?: string|null, license?: string|null}>}, safetyRatings: array<int, array{category:
     *     string, probability: string, blocked: bool|null}>, content: array{parts: array<int, array{text:
     *     string, inlineData: array{mimeType: string, data: string}}>, role: string}, finishReason: string,
     *     tokenCount: int, index: int,
     * } $candidate
     *
     * @return self
     */
    public static function fromArray(array $candidate): self
    {
        $citationMetadata = isset($candidate['citationMetadata'])
            ? CitationMetadata::fromArray($candidate['citationMetadata'])
            : new CitationMetadata();

        $safetyRatings = array_map(
            static fn(array $rating): SafetyRating => SafetyRating::fromArray($rating),
            $candidate['safetyRatings'] ?? [],
        );

        $content = isset($candidate['content'])
            ? Content::fromArray($candidate['content'])
            : Content::text('', RoleEnum::Model);

        $finishReason = isset($candidate['finishReason'])
            ? FinishReasonEnum::from($candidate['finishReason'])
            : FinishReasonEnum::OTHER;

        return new self(
            $content,
            $finishReason,
            $citationMetadata,
            $safetyRatings,
            $candidate['tokenCount'] ?? 0,
            $candidate['index'] ?? 0,
        );
    }
}
