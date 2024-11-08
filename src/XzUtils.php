<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

use PetrKnap\ExternalFilter\Exception\FilterException;

/**
 * @internal shared logic
 *
 * @template TCompressException of Exception\CouldNotCompressData
 * @template TDecompressException of Exception\CouldNotDecompressData
 */
abstract class XzUtils
{
    /**
     * @param array<non-empty-string>|null $options
     *
     * @throws TCompressException&Exception\CouldNotCompressData
     */
    final public function compress(
        string $data,
        int|null $compressionPreset = null,
        array|null $options = null,
    ): string {
        try {
            return static::filterFactory()->compress($compressionPreset, $options)->filter($data);
        } catch (FilterException $reason) {
            throw new (static::compressException())(__METHOD__, $data, $reason);
        }
    }

    /**
     * @param array<non-empty-string>|null $options
     *
     * @throws TDecompressException&Exception\CouldNotDecompressData
     */
    final public function decompress(
        string $data,
        array|null $options = null,
    ): string {
        try {
            return static::filterFactory()->decompress($options)->filter($data);
        } catch (FilterException $reason) {
            throw new (static::decompressException())(__METHOD__, $data, $reason);
        }
    }

    /**
     * @return class-string<TCompressException&Exception\CouldNotCompressData>
     */
    abstract protected static function compressException(): string;

    /**
     * @return class-string<TDecompressException&Exception\CouldNotDecompressData>
     */
    abstract protected static function decompressException(): string;

    abstract protected static function filterFactory(): FilterFactory;
}
