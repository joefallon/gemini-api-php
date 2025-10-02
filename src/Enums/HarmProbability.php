<?php

declare(strict_types=1);

namespace GeminiAPI\Enums;

use InvalidArgumentException;

use function sprintf;

class HarmProbability
{
    public const HARM_PROBABILITY_UNSPECIFIED = 'HARM_PROBABILITY_UNSPECIFIED';
    public const NEGLIGIBLE                   = 'NEGLIGIBLE';
    public const LOW                          = 'LOW';
    public const MEDIUM                       = 'MEDIUM';
    public const HIGH                         = 'HIGH';

    private function __construct()
    {
    }

    public static function from(string $value): string
    {
        switch($value)
        {
            case self::HARM_PROBABILITY_UNSPECIFIED:
                return self::HARM_PROBABILITY_UNSPECIFIED;
            case self::NEGLIGIBLE:
                return self::NEGLIGIBLE;
            case self::LOW:
                return self::LOW;
            case self::MEDIUM:
                return self::MEDIUM;
            case self::HIGH:
                return self::HIGH;
            default:
                throw new InvalidArgumentException(sprintf('Invalid HarmProbability value: %s', $value));
        }
    }
}
