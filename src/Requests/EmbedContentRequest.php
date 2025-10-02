<?php

declare(strict_types=1);

namespace GeminiAPI\Requests;

use BadMethodCallException;
use GeminiAPI\Enums\ModelName;
use GeminiAPI\Enums\TaskType;
use GeminiAPI\Resources\Content;
use GeminiAPI\Traits\ModelNameToString;
use JsonSerializable;

use function json_encode;

class EmbedContentRequest implements JsonSerializable, RequestInterface
{
    use ModelNameToString;

    /** @var ModelName|string */
    public           $modelName;
    public Content   $content;
    public ?string $taskType;
    public ?string   $title;

    /**
     * @param ModelName|string $modelName
     * @param Content          $content
     * @param TaskType|null    $taskType
     * @param string|null      $title
     */
    public function __construct(
        $modelName,
        Content $content,
        ?string $taskType = null,
        ?string $title = null
    ) {
        $this->modelName = $modelName;
        $this->content = $content;
        $this->taskType = $taskType;
        $this->title = $title;

        if(isset($this->title) && $this->taskType !== TaskType::RETRIEVAL_DOCUMENT)
        {
            throw new BadMethodCallException('Title is only applicable when TaskType is RETRIEVAL_DOCUMENT');
        }
    }

    public function getOperation(): string
    {
        return "{$this->modelNameToString($this->modelName)}:embedContent";
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
     *     content: Content,
     *     taskType?: TaskType,
     *     title?: string,
     * }
     */
    public function jsonSerialize(): array
    {
        $arr = [
            'content' => $this->content,
        ];

        if(isset($this->taskType))
        {
            $arr['taskType'] = $this->taskType;
        }

        if(isset($this->title))
        {
            $arr['title'] = $this->title;
        }

        return $arr;
    }

    public function __toString(): string
    {
        return json_encode($this) ?: '';
    }
}
