<?php

declare(strict_types=1);

namespace GeminiAPI\Requests;

class ListModelsRequest implements RequestInterface, \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [];
    }
    public function getOperation(): string
    {
        return 'models';
    }

    public function getHttpMethod(): string
    {
        return 'GET';
    }

    public function getHttpPayload(): string
    {
        return '';
    }

    public function __toString(): string
    {
        return '';
    }
}
