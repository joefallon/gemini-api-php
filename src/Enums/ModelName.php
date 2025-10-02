<?php

declare(strict_types=1);

namespace GeminiAPI\Enums;

use InvalidArgumentException;

use function sprintf;

/**
 * @deprecated Use constants from GeminiAPI\Resources\ModelName instead
 */
class ModelName
{
    public const Default           = 'models/text-bison-001';
    public const GeminiPro         = 'models/gemini-pro';
    public const GeminiPro10       = 'models/gemini-1.0-pro';
    public const GeminiPro10Latest = 'models/gemini-1.0-pro-latest';
    public const GeminiPro15       = 'models/gemini-1.5-pro';
    public const GeminiPro15Flash  = 'models/gemini-1.5-flash';
    public const GeminiProVision   = 'models/gemini-pro-vision';
    public const Embedding         = 'models/embedding-001';
    public const AQA               = 'models/aqa';

    private function __construct()
    {
    }

    public static function from(string $value): string
    {
        switch($value)
        {
            case self::Default:
                return self::Default;
            case self::GeminiPro:
                return self::GeminiPro;
            case self::GeminiPro10:
                return self::GeminiPro10;
            case self::GeminiPro10Latest:
                return self::GeminiPro10Latest;
            case self::GeminiPro15:
                return self::GeminiPro15;
            case self::GeminiPro15Flash:
                return self::GeminiPro15Flash;
            case self::GeminiProVision:
                return self::GeminiProVision;
            case self::Embedding:
                return self::Embedding;
            case self::AQA:
                return self::AQA;
            default:
                throw new InvalidArgumentException(sprintf('Invalid ModelName value: %s', $value));
        }
    }
}
