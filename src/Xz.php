<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

use Throwable;

/**
 * @extends XzUtils<Exception\XzException>
 */
final class Xz extends XzUtils
{
    protected static function command(): string
    {
        return 'xz';
    }

    protected static function couldNotCompressData(string $data, Throwable $reason): never
    {
        throw new Exception\XzCouldNotCompressData(
            self::class,
            $data,
            $reason,
        );
    }

    protected static function couldNotDecompressData(string $data, Throwable $reason): never
    {
        throw new Exception\XzCouldNotDecompressData(
            self::class,
            $data,
            $reason,
        );
    }
}
