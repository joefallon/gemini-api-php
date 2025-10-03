<?php

declare(strict_types=1);

namespace GeminiAPI\Enums;

use InvalidArgumentException;

use function sprintf;

/**
 *
 */
class BlockReasonEnum
{
    public const BLOCK_REASON_UNSPECIFIED = 'BLOCK_REASON_UNSPECIFIED';
    public const SAFETY                   = 'SAFETY';
    public const OTHER                    = 'OTHER';

    private function __construct()
    {
    }

    public static function from(string $value): string
    {
        switch($value)
        {
            case self::BLOCK_REASON_UNSPECIFIED:
                return self::BLOCK_REASON_UNSPECIFIED;
            case self::SAFETY:
                return self::SAFETY;
            case self::OTHER:
                return self::OTHER;
            default:
                throw new InvalidArgumentException(sprintf('Invalid BlockReason value: %s', $value));
        }
    }
}
