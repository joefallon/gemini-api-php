<?php

declare(strict_types=1);

namespace GeminiAPI\Tests\Unit\Resources;

use GeminiAPI\Enums\MimeTypeEnum;
use GeminiAPI\Enums\RoleEnum;
use GeminiAPI\Resources\Content;
use GeminiAPI\Resources\Parts\FilePart;
use GeminiAPI\Resources\Parts\ImagePart;
use GeminiAPI\Resources\Parts\TextPart;
use PHPUnit\Framework\TestCase;

class ContentTest extends TestCase
{
    public function testConstructorWithNoContents()
    {
        $content = new Content([], RoleEnum::User);
        self::assertInstanceOf(Content::class, $content);
        self::assertEmpty($content->parts);
        self::assertEquals(RoleEnum::User, $content->role);
    }

    public function testConstructorWithContents()
    {
        $content = new Content(
            [new TextPart('this is a text')],
            RoleEnum::User,
        );
        self::assertInstanceOf(Content::class, $content);
        self::assertEquals([new TextPart('this is a text')], $content->parts);
        self::assertEquals(RoleEnum::User, $content->role);
    }

    public function testText()
    {
        $content = Content::text('this is a text', RoleEnum::Model);
        self::assertInstanceOf(Content::class, $content);
        self::assertEquals([new TextPart('this is a text')], $content->parts);
        self::assertEquals(RoleEnum::Model, $content->role);
    }

    public function testTextWithEnumRole()
    {
        $content = Content::text('this is a text', RoleEnum::Model);
        self::assertInstanceOf(Content::class, $content);
        self::assertEquals([new TextPart('this is a text')], $content->parts);
        self::assertEquals(RoleEnum::Model, $content->role);
    }

    public function testImage()
    {
        $content = Content::image(
            MimeTypeEnum::IMAGE_JPEG,
            'this is an image',
            RoleEnum::Model,
        );
        self::assertInstanceOf(Content::class, $content);
        self::assertEquals([new ImagePart(MimeTypeEnum::IMAGE_JPEG, 'this is an image')], $content->parts);
        self::assertEquals(RoleEnum::Model, $content->role);
    }

    public function testImageWithEnumMimeTypeAndRole()
    {
        $content = Content::image(
            MimeTypeEnum::IMAGE_JPEG,
            'this is an image',
            RoleEnum::Model,
        );
        self::assertInstanceOf(Content::class, $content);
        self::assertEquals([new ImagePart(MimeTypeEnum::IMAGE_JPEG, 'this is an image')], $content->parts);
        self::assertEquals(RoleEnum::Model, $content->role);
    }

    public function testFile()
    {
        $content = Content::file(
            MimeTypeEnum::IMAGE_JPEG,
            'this is a file',
            RoleEnum::Model,
        );
        self::assertInstanceOf(Content::class, $content);
        self::assertEquals([new FilePart(MimeTypeEnum::IMAGE_JPEG, 'this is a file')], $content->parts);
        self::assertEquals(RoleEnum::Model, $content->role);
    }

    public function testTextAndImage()
    {
        $content = Content::textAndImage(
            'this is a text',
            MimeTypeEnum::IMAGE_JPEG,
            'this is an image',
            RoleEnum::Model,
        );
        $parts = [
            new TextPart('this is a text'),
            new ImagePart(MimeTypeEnum::IMAGE_JPEG, 'this is an image'),
        ];
        self::assertInstanceOf(Content::class, $content);
        self::assertEquals($parts, $content->parts);
        self::assertEquals(RoleEnum::Model, $content->role);
    }

    public function testTextAndImageWithEnumMimeTypeAndRole()
    {
        $content = Content::textAndImage(
            'this is a text',
            MimeTypeEnum::IMAGE_JPEG,
            'this is an image',
            RoleEnum::Model,
        );
        $parts = [
            new TextPart('this is a text'),
            new ImagePart(MimeTypeEnum::IMAGE_JPEG, 'this is an image'),
        ];
        self::assertInstanceOf(Content::class, $content);
        self::assertEquals($parts, $content->parts);
        self::assertEquals(RoleEnum::Model, $content->role);
    }

    public function testTextAndFile()
    {
        $content = Content::textAndFile(
            'this is a text',
            MimeTypeEnum::IMAGE_JPEG,
            'this is a file',
            RoleEnum::Model,
        );
        $parts = [
            new TextPart('this is a text'),
            new FilePart(MimeTypeEnum::IMAGE_JPEG, 'this is a file'),
        ];
        self::assertInstanceOf(Content::class, $content);
        self::assertEquals($parts, $content->parts);
        self::assertEquals(RoleEnum::Model, $content->role);
    }

    public function testAddText()
    {
        $content = new Content([], RoleEnum::User);
        $content->addText('this is a text');
        self::assertEquals([new TextPart('this is a text')], $content->parts);
    }

    public function testAddTextWithEnumRole()
    {
        $content = new Content([], RoleEnum::User);
        $content->addText('this is a text');
        self::assertEquals([new TextPart('this is a text')], $content->parts);
    }

    public function testAddImage()
    {
        $content = new Content([], RoleEnum::User);
        $content->addImage(MimeTypeEnum::IMAGE_JPEG, 'this is an image');
        self::assertEquals([new ImagePart(MimeTypeEnum::IMAGE_JPEG, 'this is an image')], $content->parts);
    }

    public function testAddImageWithEnumMimeTypeAndRole()
    {
        $content = new Content([], RoleEnum::User);
        $content->addImage(MimeTypeEnum::IMAGE_JPEG, 'this is an image');
        self::assertEquals([new ImagePart(MimeTypeEnum::IMAGE_JPEG, 'this is an image')], $content->parts);
    }

    public function testJsonSerialize()
    {
        $content = new Content(
            [new TextPart('this is a text')],
            RoleEnum::User,
        );
        $expected = [
            'parts' => [
                new TextPart('this is a text'),
            ],
            'role' => RoleEnum::User,
        ];
        self::assertEquals($expected, $content->jsonSerialize());
    }

    public function test__toString()
    {
        $content = new Content(
            [new TextPart('this is a text')],
            RoleEnum::User,
        );
        $expected = '{"parts":[{"text":"this is a text"}],"role":"user"}';
        self::assertEquals($expected, (string) $content);
    }

    public function testFromArrayWithNoParts()
    {
        $content = Content::fromArray([
            'parts' => [],
            'role' => 'user',
        ]);
        self::assertInstanceOf(Content::class, $content);
        self::assertEmpty($content->parts);
        self::assertEquals(RoleEnum::User, $content->role);
    }

    public function testFromArrayWithParts()
    {
        $content = Content::fromArray([
            'parts' => [
                ['text' => 'this is a text'],
                ['inlineData' => ['mimeType' => 'image/jpeg', 'data' => 'this is an image']],
            ],
            'role' => 'user',
        ]);
        $parts = [
            new TextPart('this is a text'),
            new FilePart(MimeTypeEnum::IMAGE_JPEG, 'this is an image'),
        ];
        self::assertInstanceOf(Content::class, $content);
        self::assertEquals($parts, $content->parts);
        self::assertEquals(RoleEnum::User, $content->role);
    }

    public function testFromArrayWithEnumRole()
    {
        $content = Content::fromArray([
            'parts' => [],
            'role' => RoleEnum::User,
        ]);
        self::assertInstanceOf(Content::class, $content);
        self::assertEmpty($content->parts);
        self::assertEquals(RoleEnum::User, $content->role);
    }
}
