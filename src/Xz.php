<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

/**
 * @extends XzUtils<Exception\XzCouldNotCompressData,Exception\XzCouldNotDecompressData>
 */
final class Xz extends XzUtils
{
    protected static function command(): string
    {
        return 'xz';
    }

    protected static function compressException(): string
    {
        return Exception\XzCouldNotCompressData::class;
    }

    protected static function decompressException(): string
    {
        return Exception\XzCouldNotDecompressData::class;
    }
}
