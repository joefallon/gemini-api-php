<?php

declare(strict_types=1);

namespace GeminiAPI\Requests;

use GeminiAPI\Enums\ModelName;
use GeminiAPI\GenerationConfig;
use GeminiAPI\Resources\Content;
use GeminiAPI\SafetySetting;
use GeminiAPI\Traits\ArrayTypeValidator;
use GeminiAPI\Traits\ModelNameToString;
use JsonSerializable;

use function json_encode;

class GenerateContentRequest implements JsonSerializable, RequestInterface
{
    use ArrayTypeValidator;
    use ModelNameToString;

    /** @var ModelName|string */
    public $modelName;
    /** @var Content[] */
    public array $contents;
    /** @var SafetySetting[] */
    public array             $safetySettings;
    public ?GenerationConfig $generationConfig;
    public ?Content          $systemInstruction;

    /**
     * @param ModelName|string      $modelName
     * @param Content[]             $contents
     * @param SafetySetting[]       $safetySettings
     * @param GenerationConfig|null $generationConfig
     * @param ?Content              $systemInstruction
     */
    public function __construct(
        $modelName,
        array $contents,
        array $safetySettings = [],
        ?GenerationConfig $generationConfig = null,
        ?Content $systemInstruction = null
    ) {
        $this->modelName = $modelName;
        $this->contents = $contents;
        $this->safetySettings = $safetySettings;
        $this->generationConfig = $generationConfig;
        $this->systemInstruction = $systemInstruction;

        $this->ensureArrayOfType($this->contents, Content::class);
        $this->ensureArrayOfType($this->safetySettings, SafetySetting::class);
    }

    public function getOperation(): string
    {
        return "{$this->modelNameToString($this->modelName)}:generateContent";
    }

    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getHttpPayload(): string
    {
        return (string)$this;
    }

    /**
     * @return array{
     *     model: string,
     *     contents: Content[],
     *     safetySettings?: SafetySetting[],
     *     generationConfig?: GenerationConfig,
     *     systemInstruction?: Content,
     * }
     */
    public function jsonSerialize(): array
    {
        $arr = [
            'model'    => $this->modelNameToString($this->modelName),
            'contents' => $this->contents,
        ];

        if(!empty($this->safetySettings))
        {
            $arr['safetySettings'] = $this->safetySettings;
        }

        if($this->generationConfig)
        {
            $arr['generationConfig'] = $this->generationConfig;
        }

        if($this->systemInstruction)
        {
            $arr['systemInstruction'] = $this->systemInstruction;
        }

        return $arr;
    }

    public function __toString(): string
    {
        return json_encode($this) ?: '';
    }
}
