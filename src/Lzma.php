<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

/**
 * @extends XzUtils<Exception\LzmaCouldNotCompressData,Exception\LzmaCouldNotDecompressData>
 */
final class Lzma extends XzUtils
{
    protected static function compressException(): string
    {
        return Exception\LzmaCouldNotCompressData::class;
    }

    /**
     * @internal public for testing purposes only
     */
    public static function decompressException(): string
    {
        return Exception\LzmaCouldNotDecompressData::class;
    }

    protected static function filterFactory(): FilterFactory
    {
        return FilterFactory::lzma();
    }
}
