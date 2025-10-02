<?php

declare(strict_types=1);

namespace GeminiAPI\Resources;

use GeminiAPI\Traits\ArrayTypeValidator;
use InvalidArgumentException;

use function is_array;

class ContentEmbedding implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [
            'values' => $this->values,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this) ?: '';
    }
    use ArrayTypeValidator;

    public array $values;

    /**
     * @param float[] $values
     */
    public function __construct(
        array $values
    ) {
        $this->values = $values;
        $this->ensureArrayOfFloat($this->values);
    }

    /**
     * @param array{values: float[]} $values
     *
     * @return self
     */
    public static function fromArray(array $values): self
    {
        if(!isset($values['values']) || !is_array($values['values']))
        {
            throw new InvalidArgumentException('The required "values" key is missing or is not an array');
        }

        return new self($values['values']);
    }
}
