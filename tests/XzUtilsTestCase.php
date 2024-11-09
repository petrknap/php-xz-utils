<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

use PetrKnap\Shorts\Exception\CouldNotProcessData;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Throwable;

#[CoversClass(FilterFactory::class)]
abstract class XzUtilsTestCase extends TestCase
{
    private const DATA_B64 = 'h/J4V2gAK1njeEOqyTiTjg==';

    #[DataProvider('data')]
    final public function testCompressesData(string $decompressed, string $compressed, int|null $compressionPreset): void
    {
        self::assertSame(
            bin2hex($compressed),
            bin2hex(static::getInstance()->compress($decompressed, $compressionPreset)),
        );
    }

    #[DataProvider('data')]
    final public function testDecompressesData(string $decompressed, string $compressed): void
    {
        self::assertSame(
            bin2hex($decompressed),
            bin2hex(static::getInstance()->decompress($compressed)),
        );
    }

    final public function testDecompressThrowsCorrectlyOnWrongData(): void
    {
        self::expectException(Exception\Exception::class);

        try {
            static::getInstance()->decompress('wrong data');
        } catch (Throwable $throwable) {
            self::assertInstanceOf(call_user_func([static::getInstance()::class, 'decompressException']), $throwable);
            /** @var CouldNotProcessData $throwable */
            self::assertSame('wrong data', $throwable->getData());

            throw $throwable;
        }
    }

    public static function data(): array
    {
        $decompressed = base64_decode(self::DATA_B64);
        $compressed = static::getCompressedDataAsBase64();
        return [
            'default compression preset' => [
                $decompressed,
                base64_decode($compressed['default']),
                null,
            ],
            'compression preset 0' => [
                $decompressed,
                base64_decode($compressed['0']),
                0,
            ],
            'compression preset 9' => [
                $decompressed,
                base64_decode($compressed['9']),
                9,
            ],
        ];
    }

    abstract protected static function getInstance(): XzUtils;

    /**
     * @return array{
     *     'default': non-empty-string,
     *     '0': non-empty-string,
     *     '9': non-empty-string,
     * } compressed {@see self::DATA_B64}
     */
    abstract protected static function getCompressedDataAsBase64(): array;
}
