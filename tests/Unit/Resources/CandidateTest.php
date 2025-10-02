<?php

declare(strict_types=1);

namespace GeminiAPI\Tests\Unit\Resources;

use GeminiAPI\Enums\FinishReason;
use GeminiAPI\Enums\HarmBlockThreshold;
use GeminiAPI\Enums\HarmCategory;
use GeminiAPI\Enums\HarmProbability;
use GeminiAPI\Enums\Role;
use GeminiAPI\Enums\FinishReason as FinishReasonEnum;
use GeminiAPI\Enums\HarmCategory as HarmCategoryEnum;
use GeminiAPI\Enums\HarmProbability as HarmProbabilityEnum;
use GeminiAPI\Enums\Role as RoleEnum;
use GeminiAPI\Resources\Candidate;
use GeminiAPI\Resources\CitationMetadata;
use GeminiAPI\Resources\Content;
use GeminiAPI\Resources\SafetyRating;
use GeminiAPI\SafetySetting;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CandidateTest extends TestCase
{
    public function testConstructor()
    {
        $candidate = new Candidate(
            new Content([], Role::User),
            FinishReason::OTHER,
            new CitationMetadata(),
            [],
            1,
            1,
        );
        self::assertInstanceOf(Candidate::class, $candidate);
    }

    public function testConstructorWithEnumFinishReason()
    {
        $candidate = new Candidate(
            new Content([], RoleEnum::User),
            FinishReasonEnum::OTHER,
            new CitationMetadata(),
            [],
            1,
            1,
        );
        self::assertInstanceOf(Candidate::class, $candidate);
    }

    public function testConstructorWithSafetyRatings()
    {
        $candidate = new Candidate(
            new Content([], Role::User),
            FinishReason::OTHER,
            new CitationMetadata(),
            [
                new SafetyRating(
                    HarmCategory::HARM_CATEGORY_MEDICAL,
                    HarmProbability::HIGH,
                    true,
                ),
                new SafetyRating(
                    HarmCategory::HARM_CATEGORY_DANGEROUS_CONTENT,
                    HarmProbability::LOW,
                    false,
                ),
            ],
            1,
            1,
        );
        self::assertInstanceOf(Candidate::class, $candidate);
    }

    public function testConstructorWithEnumSafetyRatings()
    {
        $candidate = new Candidate(
            new Content([], RoleEnum::User),
            FinishReasonEnum::OTHER,
            new CitationMetadata(),
            [
                new SafetyRating(
                    HarmCategoryEnum::HARM_CATEGORY_MEDICAL,
                    HarmProbabilityEnum::HIGH,
                    true,
                ),
                new SafetyRating(
                    HarmCategoryEnum::HARM_CATEGORY_DANGEROUS_CONTENT,
                    HarmProbabilityEnum::LOW,
                    false,
                ),
            ],
            1,
            1,
        );
        self::assertInstanceOf(Candidate::class, $candidate);
    }

    public function testConstructorWithInvalidSafetyRatings()
    {
        $this->expectException(InvalidArgumentException::class);

        new Candidate(
            new Content([], Role::User),
            FinishReason::OTHER,
            new CitationMetadata(),
            [
                new SafetyRating(
                    HarmCategory::HARM_CATEGORY_MEDICAL,
                    HarmProbability::HIGH,
                    false,
                ),
                new SafetySetting(
                    HarmCategory::HARM_CATEGORY_DANGEROUS_CONTENT,
                    HarmBlockThreshold::BLOCK_LOW_AND_ABOVE,
                ),
            ],
            1,
            1,
        );
    }

    public function testFromArray()
    {
        $candidate = Candidate::fromArray([
                                              'content'          => ['parts' => [], 'role' => 'user'],
                                              'safetyRatings'    => [],
                                              'citationMetadata' => [],
                                              'index'            => 1,
                                              'tokenCount'       => 1,
                                              'finishReason'     => 'OTHER',
                                          ]);

        self::assertInstanceOf(Candidate::class, $candidate);
    }

    public function testFromArrayWithoutContent()
    {
        $candidate = Candidate::fromArray([
                                              'safetyRatings'    => [],
                                              'citationMetadata' => [],
                                              'index'            => 1,
                                              'tokenCount'       => 1,
                                              'finishReason'     => 'OTHER',
                                          ]);

        self::assertInstanceOf(Candidate::class, $candidate);
    }

    public function testFromArrayWithoutFinishReason()
    {
        $candidate = Candidate::fromArray([
                                              'content'          => ['parts' => [], 'role' => 'user'],
                                              'safetyRatings'    => [],
                                              'citationMetadata' => [],
                                              'index'            => 1,
                                              'tokenCount'       => 1,
                                          ]);

        self::assertInstanceOf(Candidate::class, $candidate);
        self::assertEquals(FinishReason::OTHER, $candidate->finishReason);
    }

    public function testFromArrayWithEnumFinishReason()
    {
        $candidate = Candidate::fromArray([
                                              'content'          => ['parts' => [], 'role' => 'user'],
                                              'safetyRatings'    => [],
                                              'citationMetadata' => [],
                                              'index'            => 1,
                                              'tokenCount'       => 1,
                                              'finishReason'     => FinishReasonEnum::OTHER,
                                          ]);

        self::assertInstanceOf(Candidate::class, $candidate);
        self::assertEquals(FinishReasonEnum::OTHER, $candidate->finishReason);
    }

    public function testJsonSerialize()
    {
        $candidate = new Candidate(
            new Content([], Role::User),
            FinishReason::OTHER,
            new CitationMetadata(),
            [],
            1,
            1,
        );
        $expected = [
            'content'          => new Content([], Role::User),
            'finishReason'     => FinishReason::OTHER,
            'citationMetadata' => new CitationMetadata(),
            'safetyRatings'    => [],
            'tokenCount'       => 1,
            'index'            => 1,
        ];
        self::assertEquals($expected, $candidate->jsonSerialize());
    }

    public function test__toString()
    {
        $candidate = new Candidate(
            new Content([], Role::User),
            FinishReason::OTHER,
            new CitationMetadata(),
            [],
            1,
            1,
        );
        $expected = '{"content":{"parts":[],"role":"user"},"finishReason":"OTHER","citationMetadata":{"citationSources":[]},"safetyRatings":[],"tokenCount":1,"index":1}';
        self::assertEquals($expected, (string)$candidate);
    }
}
