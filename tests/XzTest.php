<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class XzTest extends TestCase
{
    #[DataProvider('data')]
    public function testCompressesData(string $decompressed, string $compressed, int|null $compressionPreset): void
    {
        self::assertSame(
            bin2hex($compressed),
            bin2hex((new Xz())->compress($decompressed, $compressionPreset)),
        );
    }

    #[DataProvider('data')]
    public function testDecompressesData(string $decompressed, string $compressed): void
    {
        self::assertSame(
            bin2hex($decompressed),
            bin2hex((new Xz())->decompress($compressed)),
        );
    }

    public static function data(): array
    {
        $decompressed = base64_decode('h/J4V2gAK1njeEOqyTiTjg==');
        return [
            'default compression preset' => [
                $decompressed,
                base64_decode('/Td6WFoAAATm1rRGAgAhARYAAAB0L+WjAQAPh/J4V2gAK1njeEOqyTiTjgDL7VTjlSH1vwABKBDlC2xgH7bzfQEAAAAABFla'),
                null,
            ],
            'compression preset 0' => [
                $decompressed,
                base64_decode('/Td6WFoAAATm1rRGAgAhAQwAAACPmEGcAQAPh/J4V2gAK1njeEOqyTiTjgDL7VTjlSH1vwABKBDlC2xgH7bzfQEAAAAABFla'),
                0,
            ],
            'compression preset 9' => [
                $decompressed,
                base64_decode('/Td6WFoAAATm1rRGAgAhARwAAAAQz1jMAQAPh/J4V2gAK1njeEOqyTiTjgDL7VTjlSH1vwABKBDlC2xgH7bzfQEAAAAABFla'),
                9,
            ],
        ];
    }
}
