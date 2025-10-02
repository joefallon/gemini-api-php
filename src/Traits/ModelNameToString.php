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
                        if ($this->modelName instanceof ModelName) {
                            return $this->modelName->value;
                        }
        
                        if (str_starts_with($this->modelName, 'models/')) {
                            return $this->modelName;
                        }
        
                        return 'models/' . $this->modelName;    }
}
