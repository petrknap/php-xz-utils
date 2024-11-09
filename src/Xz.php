<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

/**
 * @extends XzUtils<Exception\XzCouldNotCompressData,Exception\XzCouldNotDecompressData>
 */
final class Xz extends XzUtils
{
    protected static function compressException(): string
    {
        return Exception\XzCouldNotCompressData::class;
    }

    /**
     * @internal public for testing purposes only
     */
    public static function decompressException(): string
    {
        return Exception\XzCouldNotDecompressData::class;
    }

    protected static function filterFactory(): FilterFactory
    {
        return FilterFactory::xz();
    }
}
