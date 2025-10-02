<?php

declare(strict_types=1);

namespace GeminiAPI\Responses;

use GeminiAPI\Resources\Model;

class ListModelsResponse
{
    public array $models;

    /**
     * @param Model[] $models
     */
    public function __construct(
        array $models
    ) {
        $this->models = $models;
    }

    /**
     * @param array{models: array<int, array{
     *   name: string,
     *   version: string,
     *   displayName: string,
     *   description: string,
     *   inputTokenLimit: int,
     *   outputTokenLimit: int,
     *   supportedGenerationMethods: string[],
     *   temperature?: float,
     *   topP?: float,
     *   topK?: int,
     *  }>} $json
     *
     * @return self
     */
    public static function fromArray(array $json): self
    {
        $models = array_map(
            static fn(array $arr): Model => Model::fromArray($arr),
            $json['models'],
        );

        return new self($models);
    }
}
