<?php

declare(strict_types=1);

namespace GeminiAPI\Enums;

use InvalidArgumentException;

use function sprintf;

class RoleEnum
{
    public const User  = 'user';
    public const Model = 'model';

    private function __construct()
    {
    }

    public static function from(string $value): string
    {
        switch($value)
        {
            case self::User:
                return self::User;
            case self::Model:
                return self::Model;
            default:
                throw new InvalidArgumentException(sprintf('Invalid Role value: %s', $value));
        }
    }
}
