<?php

namespace GeminiAPI\Traits;

use GeminiAPI\Enums\ModelName;

trait ModelNameToString
{
    /**
     * @param ModelName|string $modelName
     *
     * @return string
     */
    private function modelNameToString($modelName): string
    {
        return is_string($modelName) ? "models/$modelName" : $modelName->value;
    }
}
