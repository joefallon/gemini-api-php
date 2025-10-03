<?php

declare(strict_types=1);

namespace GeminiAPI\Enums;

use InvalidArgumentException;

use function sprintf;

class HarmCategoryEnum
{
    public const HARM_CATEGORY_UNSPECIFIED       = 'HARM_CATEGORY_UNSPECIFIED';
    public const HARM_CATEGORY_DEROGATORY        = 'HARM_CATEGORY_DEROGATORY';
    public const HARM_CATEGORY_TOXICITY          = 'HARM_CATEGORY_TOXICITY';
    public const HARM_CATEGORY_VIOLENCE          = 'HARM_CATEGORY_VIOLENCE';
    public const HARM_CATEGORY_SEXUAL            = 'HARM_CATEGORY_SEXUAL';
    public const HARM_CATEGORY_MEDICAL           = 'HARM_CATEGORY_MEDICAL';
    public const HARM_CATEGORY_DANGEROUS         = 'HARM_CATEGORY_DANGEROUS';
    public const HARM_CATEGORY_HARASSMENT        = 'HARM_CATEGORY_HARASSMENT';
    public const HARM_CATEGORY_HATE_SPEECH       = 'HARM_CATEGORY_HATE_SPEECH';
    public const HARM_CATEGORY_SEXUALLY_EXPLICIT = 'HARM_CATEGORY_SEXUALLY_EXPLICIT';
    public const HARM_CATEGORY_DANGEROUS_CONTENT = 'HARM_CATEGORY_DANGEROUS_CONTENT';

    private function __construct()
    {
    }

    public static function from(string $value): string
    {
        switch($value)
        {
            case self::HARM_CATEGORY_UNSPECIFIED:
                return self::HARM_CATEGORY_UNSPECIFIED;
            case self::HARM_CATEGORY_DEROGATORY:
                return self::HARM_CATEGORY_DEROGATORY;
            case self::HARM_CATEGORY_TOXICITY:
                return self::HARM_CATEGORY_TOXICITY;
            case self::HARM_CATEGORY_VIOLENCE:
                return self::HARM_CATEGORY_VIOLENCE;
            case self::HARM_CATEGORY_SEXUAL:
                return self::HARM_CATEGORY_SEXUAL;
            case self::HARM_CATEGORY_MEDICAL:
                return self::HARM_CATEGORY_MEDICAL;
            case self::HARM_CATEGORY_DANGEROUS:
                return self::HARM_CATEGORY_DANGEROUS;
            case self::HARM_CATEGORY_HARASSMENT:
                return self::HARM_CATEGORY_HARASSMENT;
            case self::HARM_CATEGORY_HATE_SPEECH:
                return self::HARM_CATEGORY_HATE_SPEECH;
            case self::HARM_CATEGORY_SEXUALLY_EXPLICIT:
                return self::HARM_CATEGORY_SEXUALLY_EXPLICIT;
            case self::HARM_CATEGORY_DANGEROUS_CONTENT:
                return self::HARM_CATEGORY_DANGEROUS_CONTENT;
            default:
                throw new InvalidArgumentException(sprintf('Invalid HarmCategory value: %s', $value));
        }
    }
}
