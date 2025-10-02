<?php

declare(strict_types=1);

namespace GeminiAPI\Enums;

use InvalidArgumentException;

use function sprintf;

class MimeType
{
    // Will not rename to APPLICATION_PDF to keep the backwards compatibility
    public const FILE_PDF               = 'application/pdf';
    public const APPLICATION_JAVASCRIPT = 'application/x-javascript';
    public const APPLICATION_PYTHON     = 'application/x-python';

    public const TEXT_PLAIN    = 'text/plain';
    public const TEXT_HTML     = 'text/html';
    public const TEXT_CSS      = 'text/css';
    public const TEXT_MARKDOWN = 'text/md';
    public const TEXT_CSV      = 'text/csv';
    public const TEXT_XML      = 'text/xml';
    public const TEXT_RTF      = 'text/rtf';

    public const IMAGE_PNG  = 'image/png';
    public const IMAGE_JPEG = 'image/jpeg';
    public const IMAGE_HEIC = 'image/heic';
    public const IMAGE_HEIF = 'image/heif';
    public const IMAGE_WEBP = 'image/webp';

    private function __construct()
    {
    }

    public static function from(string $value): string
    {
        switch($value)
        {
            case self::FILE_PDF:
                return self::FILE_PDF;
            case self::APPLICATION_JAVASCRIPT:
                return self::APPLICATION_JAVASCRIPT;
            case self::APPLICATION_PYTHON:
                return self::APPLICATION_PYTHON;
            case self::TEXT_PLAIN:
                return self::TEXT_PLAIN;
            case self::TEXT_HTML:
                return self::TEXT_HTML;
            case self::TEXT_CSS:
                return self::TEXT_CSS;
            case self::TEXT_MARKDOWN:
                return self::TEXT_MARKDOWN;
            case self::TEXT_CSV:
                return self::TEXT_CSV;
            case self::TEXT_XML:
                return self::TEXT_XML;
            case self::TEXT_RTF:
                return self::TEXT_RTF;
            case self::IMAGE_PNG:
                return self::IMAGE_PNG;
            case self::IMAGE_JPEG:
                return self::IMAGE_JPEG;
            case self::IMAGE_HEIC:
                return self::IMAGE_HEIC;
            case self::IMAGE_HEIF:
                return self::IMAGE_HEIF;
            case self::IMAGE_WEBP:
                return self::IMAGE_WEBP;
            default:
                throw new InvalidArgumentException(sprintf('Invalid MimeType value: %s', $value));
        }
    }
}
