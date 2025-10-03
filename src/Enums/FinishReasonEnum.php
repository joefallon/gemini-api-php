<?php

declare(strict_types=1);

namespace GeminiAPI\Enums;

use InvalidArgumentException;

use function sprintf;

/**
 *
 */
class FinishReasonEnum
{
    public const FINISH_REASON_UNSPECIFIED = 'FINISH_REASON_UNSPECIFIED';
    public const STOP                      = 'STOP';
    public const MAX_TOKENS                = 'MAX_TOKENS';
    public const SAFETY                    = 'SAFETY';
    public const RECITATION                = 'RECITATION';
    public const OTHER                     = 'OTHER';

    private function __construct()
    {
    }

    public static function from(string $value): string
    {
        switch($value)
        {
            case self::FINISH_REASON_UNSPECIFIED:
                return self::FINISH_REASON_UNSPECIFIED;
            case self::STOP:
                return self::STOP;
            case self::MAX_TOKENS:
                return self::MAX_TOKENS;
            case self::SAFETY:
                return self::SAFETY;
            case self::RECITATION:
                return self::RECITATION;
            case self::OTHER:
                return self::OTHER;
            default:
                throw new InvalidArgumentException(sprintf('Invalid FinishReason value: %s', $value));
        }
    }
}
