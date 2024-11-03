<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Throwable;

final class Xz
{
    /**
     * @param array<non-empty-string> $options
     *
     * @throws Exception\XzCouldNotCompressData
     */
    public function compress(
        string $data,
        int|null $compressionPreset = null,
        array $options = [],
    ): string {
        $command = [
            'xz',
            '--compress',
        ];
        if ($compressionPreset !== null) {
            $command[] = '-' . $compressionPreset;
        }
        try {
            return self::run(array_merge($command, $options), $data);
        } catch (Throwable $reason) {
            throw new Exception\XzCouldNotCompressData(__METHOD__, $data, $reason);
        }
    }

    /**
     * @param array<non-empty-string> $options
     *
     * @throws Exception\XzCouldNotDecompressData
     */
    public function decompress(
        string $data,
        array $options = [],
    ): string {
        $command = [
            'xz',
            '--decompress',
        ];
        try {
            return self::run(array_merge($command, $options), $data);
        } catch (Throwable $reason) {
            throw new Exception\XzCouldNotDecompressData(__METHOD__, $data, $reason);
        }
    }

    /**
     * @param non-empty-array<non-empty-string> $command
     *
     * @throws ProcessFailedException
     *
     * @todo move it to another package
     */
    private static function run(array $command, string $input): string
    {
        $process = new Process($command);
        $process->setInput($input);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        return $process->getOutput();
    }
}
