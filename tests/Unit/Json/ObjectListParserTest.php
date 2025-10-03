<?php declare(strict_types=1);

namespace GeminiAPI\Tests\Unit\Json;

use GeminiAPI\Json\ObjectListParser;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class ObjectListParserTest extends TestCase
{
    public function testConsumeSingleJsonObjectThrowsException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('ObjectListParser could not decode the given message');

        $parser = new ObjectListParser(fn() => $this->fail('Callback should not be invoked.'));
        $parser->consume('{"key": "value"}');
    }

    public function testConsumeMultipleJsonObjectsThrowsExceptionOnFirst(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('ObjectListParser could not decode the given message');

        $parser = new ObjectListParser(fn() => $this->fail('Callback should not be invoked.'));
        $parser->consume('{"a": 1}{"b": 2}');
    }

    public function testConsumePartialJsonObjectDoesNotThrow(): void
    {
        $parsedObjects = [];
        $callback = function (array $json) use (&$parsedObjects): void {
            $parsedObjects[] = $json;
        };

        $parser = new ObjectListParser($callback);
        $jsonString = '{"key": "value"';

        $consumed = $parser->consume($jsonString);

        self::assertCount(0, $parsedObjects);
        self::assertEquals(strlen($jsonString), $consumed);
    }

    public function testConsumeJsonObjectSplitAcrossCallsThrowsExceptionOnCompletion(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('ObjectListParser could not decode the given message');

        $parser = new ObjectListParser(fn() => $this->fail('Callback should not be invoked.'));
        $parser->consume('{"key": ');
        $parser->consume('"value"}');
    }

    public function testConsumeWithNestedJsonObjectThrowsException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('ObjectListParser could not decode the given message');

        $parser = new ObjectListParser(fn() => $this->fail('Callback should not be invoked.'));
        $parser->consume('{"outer": {"inner": "value"}}');
    }

    public function testConsumeWithStringsAndEscapedCharactersDoesNotThrow(): void
    {
        $parsedObjects = [];
        $callback = function (array $json) use (&$parsedObjects): void {
            $this->fail('Callback should not be invoked.');
        };

        $parser = new ObjectListParser($callback);
        $parser->consume('{"key": "a string with \"quotes\" and a backslash \\"}');

        // We are just documenting the current buggy behavior, which is a silent failure.
        self::assertCount(0, $parsedObjects);
    }

    public function testBracesInsideStringsAreIgnoredAndThrowsExceptionOnCompletion(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('ObjectListParser could not decode the given message');

        $parser = new ObjectListParser(fn() => $this->fail('Callback should not be invoked.'));
        $parser->consume('{"key": "value with { and } braces"}');
    }

    public function testConsumeInvalidJsonThrowsException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('ObjectListParser could not decode the given message');

        $parser = new ObjectListParser(fn() => $this->fail('Callback should not be invoked.'));
        $parser->consume('junk before {"key": "value"}');
    }
}