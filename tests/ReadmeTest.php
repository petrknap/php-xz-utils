<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

use PetrKnap\Shorts\PhpUnit\MarkdownFileTestInterface;
use PetrKnap\Shorts\PhpUnit\MarkdownFileTestTrait;
use PHPUnit\Framework\TestCase;

final class ReadmeTest extends TestCase implements MarkdownFileTestInterface
{
    use MarkdownFileTestTrait;

    public static function getPathToMarkdownFile(): string
    {
        return __DIR__ . '/../README.md';
    }

    public static function getExpectedOutputsOfPhpExamples(): iterable
    {
        return [
            'ext-xz' => '`data` was decoded from encoded base64(`/Td6WFoAAATm1rRGAgAhARYAAAB0L+WjAQADZGF0YQB/b0adkp8pwwABHARvLJzBH7bzfQEAAAAABFla`)',
            'object-based-approach' => '`data` was decompressed from compressed base64(`/Td6WFoAAATm1rRGAgAhARYAAAB0L+WjAQADZGF0YQB/b0adkp8pwwABHARvLJzBH7bzfQEAAAAABFla`)',
            'filter-based-approach' => '# XZ Utils (wrapper)' . PHP_EOL,
        ];
    }
}
