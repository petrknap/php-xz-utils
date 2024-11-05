<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Throwable;

/**
 * @internal shared logic
 *
 * @template TCompressException of Exception\CouldNotCompressData
 * @template TDecompressException of Exception\CouldNotDecompressData
 */
abstract class XzUtils
{
    /**
     * @param array<non-empty-string> $options
     *
     * @throws TCompressException&Exception\CouldNotCompressData
     */
    final public function compress(
        string $data,
        int|null $compressionPreset = null,
        array $options = [],
    ): string {
        $options = ['--compress', ...$options];
        if ($compressionPreset !== null) {
            $options[] = '-' . $compressionPreset;
        }
        try {
            return self::applyFilter($options, $data);
        } catch (Throwable $reason) {
            throw new (static::compressException())(__METHOD__, $data, $reason);
        }
    }

    /**
     * @param array<non-empty-string> $options
     *
     * @throws TDecompressException&Exception\CouldNotDecompressData
     */
    final public function decompress(
        string $data,
        array $options = [],
    ): string {
        $options = ['--decompress', ...$options];
        try {
            return self::applyFilter($options, $data);
        } catch (Throwable $reason) {
            throw new (static::decompressException())(__METHOD__, $data, $reason);
        }
    }

    /**
     * @return 'lzma'|'xz'
     */
    abstract protected static function command(): string;

    /**
     * @return class-string<TCompressException&Exception\CouldNotCompressData>
     */
    abstract protected static function compressException(): string;

    /**
     * @return class-string<TDecompressException&Exception\CouldNotDecompressData>
     */
    abstract protected static function decompressException(): string;

    /**
     * @param array<non-empty-string> $options
     */
    private static function applyFilter(array $options, string $input): string
    {
        $process = new Process([
            static::command(),
            ...$options,
        ]);
        $process->setInput($input);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        return $process->getOutput();
    }
}
