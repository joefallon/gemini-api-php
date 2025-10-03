<?php

declare(strict_types=1);

namespace GeminiAPI\Tests\Unit\Resources\Parts;

use GeminiAPI\Enums\MimeTypeEnum;
use GeminiAPI\Resources\Parts\ImagePart;
use PHPUnit\Framework\TestCase;

class ImagePartTest extends TestCase
{
    public function testConstructor()
    {
        $part = new ImagePart(MimeTypeEnum::IMAGE_JPEG, '');
        self::assertInstanceOf(ImagePart::class, $part);
    }

    public function testConstructorWithEnumMimeType()
    {
        $part = new ImagePart(MimeTypeEnum::IMAGE_JPEG, '');
        self::assertInstanceOf(ImagePart::class, $part);
    }

    public function testJsonSerialize()
    {
        $part = new ImagePart(MimeTypeEnum::IMAGE_JPEG, 'this is an image');
        $expected = [
            'inlineData' => [
                'mimeType' => 'image/jpeg',
                'data' => 'this is an image',
            ],
        ];
        self::assertEquals($expected, $part->jsonSerialize());
    }

    public function testJsonSerializeWithEnumMimeType()
    {
        $part = new ImagePart(MimeTypeEnum::IMAGE_JPEG, 'this is an image');
        $expected = [
            'inlineData' => [
                'mimeType' => 'image/jpeg',
                'data' => 'this is an image',
            ],
        ];
        self::assertEquals($expected, $part->jsonSerialize());
    }

    public function test__toString()
    {
        $part = new ImagePart(MimeTypeEnum::IMAGE_JPEG, 'this is an image');
        $expected = '{"inlineData":{"mimeType":"image\/jpeg","data":"this is an image"}}';
        self::assertEquals($expected, (string) $part);
    }

    public function test__toStringWithEnumMimeType()
    {
        $part = new ImagePart(MimeTypeEnum::IMAGE_JPEG, 'this is an image');
        $expected = '{"inlineData":{"mimeType":"image\/jpeg","data":"this is an image"}}';
        self::assertEquals($expected, (string) $part);
    }
}
