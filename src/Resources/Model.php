<?php

declare(strict_types=1);

namespace GeminiAPI\Resources;

use JsonSerializable;

class Model implements JsonSerializable
{
    public string $name;
    public string $version;
    public string $displayName;
    public string $description;
    public int $inputTokenLimit;
    public int $outputTokenLimit;
    public array $supportedGenerationMethods;
    public ?float $temperature;
    public ?float $topP;
    public ?int $topK;

    /**
     * @param string $name
     * @param string $version
     * @param string $displayName
     * @param string $description
     * @param int $inputTokenLimit
     * @param int $outputTokenLimit
     * @param string[] $supportedGenerationMethods
     * @param float|null $temperature
     * @param float|null $topP
     * @param int|null $topK
     */
    public function __construct(
        string $name,
        string $version,
        string $displayName,
        string $description,
        int $inputTokenLimit,
        int $outputTokenLimit,
        array $supportedGenerationMethods,
        ?float $temperature,
        ?float $topP,
        ?int $topK
    ) {
        $this->name = $name;
        $this->version = $version;
        $this->displayName = $displayName;
        $this->description = $description;
        $this->inputTokenLimit = $inputTokenLimit;
        $this->outputTokenLimit = $outputTokenLimit;
        $this->supportedGenerationMethods = $supportedGenerationMethods;
        $this->temperature = $temperature;
        $this->topP = $topP;
        $this->topK = $topK;
    }

    /**
     * @param array{
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
     *  } $model
     * @return self
     */
    public static function fromArray(array $model): self
    {
        return new self(
            $model['name'],
            $model['version'],
            $model['displayName'],
            $model['description'],
            $model['inputTokenLimit'],
            $model['outputTokenLimit'],
            $model['supportedGenerationMethods'],
            $model['temperature'] ?? null,
            $model['topP'] ?? null,
            $model['topK'] ?? null,
        );
    }

    /**
     * @return array{
     *    name: string,
     *    version: string,
     *    displayName: string,
     *    description: string,
     *    inputTokenLimit: int,
     *    outputTokenLimit: int,
     *    supportedGenerationMethods: string[],
     *    temperature?: float|null,
     *    topP?: float|null,
     *    topK?: int|null,
     *   }
     */
    public function jsonSerialize(): array
    {
        $arr = [
            'name' => $this->name,
            'version' => $this->version,
            'displayName' => $this->displayName,
            'description' => $this->description,
            'inputTokenLimit' => $this->inputTokenLimit,
            'outputTokenLimit' => $this->outputTokenLimit,
            'supportedGenerationMethods' => $this->supportedGenerationMethods,
        ];

        if ($this->temperature !== null) {
            $arr['temperature'] = $this->temperature;
        }

        if ($this->topP !== null) {
            $arr['topP'] = $this->topP;
        }

        if ($this->topK !== null) {
            $arr['topK'] = $this->topK;
        }

        return $arr;
    }
}
