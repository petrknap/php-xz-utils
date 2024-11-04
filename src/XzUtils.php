<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Throwable;

/**
 * @internal shared logic
 *
 * @template TException of Exception\Exception
 */
abstract class XzUtils
{
    /**
     * @param array<non-empty-string> $options
     *
     * @throws TException&Exception\CouldNotCompressData
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
            static::couldNotCompressData($data, $reason);
        }
    }

    /**
     * @param array<non-empty-string> $options
     *
     * @throws TException&Exception\CouldNotDecompressData
     */
    final public function decompress(
        string $data,
        array $options = [],
    ): string {
        $options = ['--decompress', ...$options];
        try {
            return self::applyFilter($options, $data);
        } catch (Throwable $reason) {
            static::couldNotDecompressData($data, $reason);
        }
    }

    /**
     * @return 'xz'
     */
    abstract protected static function command(): string;

    /**
     * @throws TException&Exception\CouldNotCompressData
     */
    abstract protected static function couldNotCompressData(string $data, Throwable $reason): never;

    /**
     * @throws TException&Exception\CouldNotDecompressData
     */
    abstract protected static function couldNotDecompressData(string $data, Throwable $reason): never;

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
