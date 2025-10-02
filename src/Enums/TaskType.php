<?php

declare(strict_types=1);

namespace GeminiAPI\Enums;

use InvalidArgumentException;

use function sprintf;

class TaskType
{
    public const TASK_TYPE_UNSPECIFIED = 'TASK_TYPE_UNSPECIFIED';
    public const RETRIEVAL_QUERY       = 'RETRIEVAL_QUERY';
    public const RETRIEVAL_DOCUMENT    = 'RETRIEVAL_DOCUMENT';
    public const SEMANTIC_SIMILARITY   = 'SEMANTIC_SIMILARITY';
    public const CLASSIFICATION        = 'CLASSIFICATION';
    public const CLUSTERING            = 'CLUSTERING';

    private function __construct()
    {
    }

    public static function from(string $value): string
    {
        switch($value)
        {
            case self::TASK_TYPE_UNSPECIFIED:
                return self::TASK_TYPE_UNSPECIFIED;
            case self::RETRIEVAL_QUERY:
                return self::RETRIEVAL_QUERY;
            case self::RETRIEVAL_DOCUMENT:
                return self::RETRIEVAL_DOCUMENT;
            case self::SEMANTIC_SIMILARITY:
                return self::SEMANTIC_SIMILARITY;
            case self::CLASSIFICATION:
                return self::CLASSIFICATION;
            case self::CLUSTERING:
                return self::CLUSTERING;
            default:
                throw new InvalidArgumentException(sprintf('Invalid TaskType value: %s', $value));
        }
    }
}
