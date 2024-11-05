<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

/**
 * @extends XzUtils<Exception\LzmaCouldNotCompressData,Exception\LzmaCouldNotDecompressData>
 */
final class Lzma extends XzUtils
{
    protected static function command(): string
    {
        return 'lzma';
    }

    protected static function compressException(): string
    {
        return Exception\LzmaCouldNotCompressData::class;
    }

    protected static function decompressException(): string
    {
        return Exception\LzmaCouldNotDecompressData::class;
    }
}
