<?php

declare(strict_types=1);

namespace GeminiAPI;

use GeminiAPI\Enums\ModelName;
use GeminiAPI\Enums\RoleEnum;
use GeminiAPI\Enums\TaskTypeEnum;
use GeminiAPI\Requests\EmbedContentRequest;
use GeminiAPI\Resources\Content;
use GeminiAPI\Resources\Parts\PartInterface;
use GeminiAPI\Responses\EmbedContentResponse;
use Psr\Http\Client\ClientExceptionInterface;

class EmbeddingModel
{
    private ?string $taskType = null;

    private Client $client;
    /** @var ModelName|string */
    public $modelName;

    /**
     * @param Client $client
     * @param ModelName|string $modelName
     */
    public function __construct(
        Client $client,
        $modelName
    ) {
        $this->client = $client;
        $this->modelName = $modelName;
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function embedContent(PartInterface ...$parts): EmbedContentResponse
    {
        $request = new EmbedContentRequest(
            $this->modelName,
            new Content($parts, RoleEnum::User),
            $this->taskType,
        );

        return $this->client->embedContent($request);
    }

    /**
     * embedContentWithTitle will override the task type with TaskType::RETRIEVAL_DOCUMENT.
     * This is not a persistent change.
     *
     * @throws ClientExceptionInterface
     */
    public function embedContentWithTitle(string $title, PartInterface ...$parts): EmbedContentResponse
    {
        $request = new EmbedContentRequest(
            $this->modelName,
            new Content($parts, RoleEnum::User),
            TaskTypeEnum::RETRIEVAL_DOCUMENT,
            $title,
        );

        return $this->client->embedContent($request);
    }

    public function withTaskType(string $taskType): self
    {
        $clone = clone $this;
        $clone->taskType = $taskType;

        return $clone;
    }
}
