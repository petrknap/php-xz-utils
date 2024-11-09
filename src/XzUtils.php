<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

use PetrKnap\ExternalFilter\Exception\FilterException;
use PetrKnap\Shorts\Exception\CouldNotProcessData;

/**
 * @internal shared logic
 *
 * @template TCompressException of Exception\Exception
 * @template TDecompressException of Exception\Exception
 */
abstract class XzUtils
{
    /**
     * @param array<non-empty-string>|null $options
     *
     * @throws TCompressException
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
     * @throws TDecompressException
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
     * @return class-string<TCompressException&CouldNotProcessData<string>>
     */
    abstract protected static function compressException(): string;

    /**
     * @return class-string<TDecompressException&CouldNotProcessData<string>>
     */
    abstract protected static function decompressException(): string;

    abstract protected static function filterFactory(): FilterFactory;
}
