<?php

declare(strict_types=1);

namespace GeminiAPI\Enums;

use InvalidArgumentException;

use function sprintf;

class HarmBlockThreshold
{
    public const HARM_BLOCK_THRESHOLD_UNSPECIFIED = 'HARM_BLOCK_THRESHOLD_UNSPECIFIED';
    public const BLOCK_LOW_AND_ABOVE              = 'BLOCK_LOW_AND_ABOVE';
    public const BLOCK_MEDIUM_AND_ABOVE           = 'BLOCK_MEDIUM_AND_ABOVE';
    public const BLOCK_ONLY_HIGH                  = 'BLOCK_ONLY_HIGH';
    public const BLOCK_NONE                       = 'BLOCK_NONE';

    private function __construct()
    {
    }

    public static function from(string $value): string
    {
        switch($value)
        {
            case self::HARM_BLOCK_THRESHOLD_UNSPECIFIED:
                return self::HARM_BLOCK_THRESHOLD_UNSPECIFIED;
            case self::BLOCK_LOW_AND_ABOVE:
                return self::BLOCK_LOW_AND_ABOVE;
            case self::BLOCK_MEDIUM_AND_ABOVE:
                return self::BLOCK_MEDIUM_AND_ABOVE;
            case self::BLOCK_ONLY_HIGH:
                return self::BLOCK_ONLY_HIGH;
            case self::BLOCK_NONE:
                return self::BLOCK_NONE;
            default:
                throw new InvalidArgumentException(sprintf('Invalid HarmBlockThreshold value: %s', $value));
        }
    }
}
